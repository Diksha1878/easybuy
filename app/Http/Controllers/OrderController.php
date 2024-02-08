<?php

namespace App\Http\Controllers;

use App\Libs\UserAuth;
use Illuminate\Http\Request;
use App\Libs\Payment;
use Illuminate\Support\Facades\Validator;
use App\Libs\CartUtil;
use App\Models\Address;
use App\Models\User;
use App\Models\Order;
use App\Models\TxnHistory;
use App\Models\Product;
use App\Models\ProductsItem;
use App\Models\Tax;
use App\Models\OrderItem;
use App\Libs\Common;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index($orderId)
    {
        $orderDetails = DB::table('orders')->where('order_id', $orderId)->where('user_id', session('user')->id)->first();
        if (empty($orderDetails)) {
            abort(404);
        }

        $orderItems = DB::table('order_items as t1')
            ->select('t1.*', 't2.item_name', 't3.name as color_name', 't3.code as color_code', 't4.name as size_name')
            ->join('products_items as t2', 't1.item_id', 't2.id')
            ->join('colors as t3', 't1.color', 't3.id')
            ->join('sizes as t4', 't1.size', 't4.id')
            ->where('t1.order_id', $orderId)
            ->get();

        return view('frontend.order_detail', ['orderDetails' => $orderDetails, 'orderItems' => $orderItems]);
    }

    public function checkout(Request $request)
    {
        $totalTokenAmount = 0;
        $totalPayableAmount = 0;
        $totalOrderAmount = 0;
        $subTotal = 0;
        $totalDelivaryCharge = 0;
        $collectableAmount = 0;
        $paymentMode = 'COD';
        $totalQty = 0;
        $orderStatus = 'PENDING';
        $txnStatus = 'INIT';

        $data['cartList'] = CartUtil::getCartList();

        if ($request->address_id) {
            $data['address_id'] = $request->address_id;
        } else {
            $data['address_id'] = Address::select('id')->where('user_id', session('user')->id)->where('is_default', '1')->first();
            if ($data['address_id']) {
                $data['address_id'] = $data['address_id']->id;
            }
        }
        if ($data['cartList']->count() === 0) {
            // return redirect('/cart')->with('error', 'Your shopping cart is empty');
            return back()->with('error', 'Your shopping cart is empty');
        }


        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'address_id' => 'required',
                'payment_method' => 'required',
            ], [
                'address_id.required' => 'Please select address.',
                'payment_method.required' => 'Please select payment method.',
            ]);

            if ($validator->fails()) {
                $errors = $this->error_processor($validator);
                $data['form_errors'] = $errors;
                $data['form_data'] = $request->all();
                return view('frontend.checkout', $data)->with('error', 'Something went wrong');
            }


            if ($data['cartList']->count() > 0) {
                foreach ($data['cartList'] as $row) {
                    $productTotal = (float)$row->price * (int)$row->qty;
                    $subTotal += $productTotal;
                    $totalTokenAmount += (float)$row->token_amt_rate * (int)$row->qty;
                    $totalDelivaryCharge += (float)$row->shipping_charge;
                    $totalQty += (int)$row->qty;
                }
            }

            $address = Address::where('user_id', session('user')->id)->where('id', $request->address_id)->first();

            $user = User::find(session('user')->id);

            $totalOrderAmount = $subTotal + $totalDelivaryCharge;

            $orderId = 'OD' . time() . mt_rand(1000, 9999);

            if ($request->payment_method === 'ONLINE' || $totalOrderAmount > 100000) {
                $paymentMode = 'ONLINE';
                $totalPayableAmount = $totalOrderAmount;
                $totalTokenAmount = 0;
                $collectableAmount = 0;
            } else {
                $paymentMode = 'COD';
                $totalPayableAmount = 0;
                $collectableAmount = $totalOrderAmount;
                if ($totalTokenAmount > 0) {
                    $paymentMode = 'ONLINE';
                    $totalPayableAmount = $totalTokenAmount;
                    $collectableAmount = $totalOrderAmount - $totalTokenAmount;
                }
            }

            $order = new Order();
            $order->order_id = $orderId;
            $order->user_id = $user->id;
            $order->total_qty = $totalQty;
            $order->total_price = $subTotal;
            $order->shipping_charges = $totalDelivaryCharge;
            $order->grand_total = $totalOrderAmount;
            $order->collectable_amount = $collectableAmount;
            $order->paid_amt = $totalPayableAmount;
            $order->receiver_name = $user->fname . ' ' . $user->lname;
            $order->shipping_address = (!empty($address->address1) ? $address->address1 . ', ' : '') . (!empty($address->address2) ? $address->address2 . ', ' : '') . (!empty($address->town_city) ? $address->town_city . ', ' : '') . (!empty($address->landmark) ? $address->landmark . ', ' : '') . ', Address Type: ' . (!empty($address->address_type) ? $address->address_type . '' : '');
            $order->address_obj = json_encode($address->toArray());
            $order->contact_number = $user->phno;
            $order->email = $user->email;
            $order->postal_code = $address->pincode;
            $order->date = date("Y-m-d");
            $order->time = date("H:i:s");
            $order->payment_method = $request->payment_method;
            $order->status = $orderStatus;
            $order->discount = 0;
            $order->txn_status = $txnStatus;
            $order->contact_no = $user->phno;
            $order->delivery_method = 'STANDARD';

            $order->state = Common::getStates()[(int)$address->state - 1]['name'];
            $order->city = $address->town_city;
            $order->save();
            // dd($order);

            if ($data['cartList']->count() > 0) {
                foreach ($data['cartList'] as $row) {
                    $product = Product::find($row->pid);
                    $item = ProductsItem::find($row->item_id);
                    $tax = Tax::find($product->tax_id);
                    $itemPrice = (float)$row->price;
                    $itemQty = (int)$row->qty;
                    $itemTotal = (float)$row->price * (int)$row->qty;
                    $taxAmt = ((float)$itemTotal * (float)$tax->percent) / (100 + (float)$tax->percent);
                    $itemPriceWithoutTax = $itemTotal - $taxAmt;

                    $orderItem = new OrderItem();
                    $orderItem->order_id = $orderId;
                    $orderItem->product_id = $product->id;
                    $orderItem->pname = $product->name;
                    $orderItem->item_id = $item->id;
                    $orderItem->price = $itemPriceWithoutTax;
                    $orderItem->color = $item->color;
                    $orderItem->size = $item->size;
                    $orderItem->product_type = 'Product';
                    $orderItem->qty = (int)$row->qty;
                    $orderItem->seller_id = 1;
                    $orderItem->seller_name = 'Easybuy';
                    $orderItem->tax_amt = (float)$taxAmt;
                    $orderItem->ship_charge = $product->shipping_charge;

                    $orderItem->save();
                }
            }


            // dd($totalOrderAmount, $totalPayableAmount, $collectableAmount, $totalTokenAmount, $paymentMode, $request->payment_method);


            if ($paymentMode === 'ONLINE') {
                $payment = Payment::make([
                    'amount' => $totalPayableAmount,
                    'merchant_order_id' => $orderId,
                    'email' => $user->email,
                    'contact' => '+91' . $user->phno,
                    'success' => Url('payment/fetch')
                ]);

                $order = Order::find($order->id);
                $order->txn_id = $payment['order_id'];
                $order->txn_status = 'PENDING';
                $order->status = 'PENDING';
                $order->save();

                $txn = new TxnHistory();
                $txn->order_id = $orderId;
                $txn->txn_id = $payment['order_id'];
                $txn->order_data = json_encode($payment);
                $txn->status = 'PENDING';
                $txn->save();
            } else {
                // dd(1);
                $order = Order::find($order->id);
                $order->status = 'PLACED';
                $order->txn_status = 'OFFLINE';
                $order->save();
                $this->sendOrderMailToUser($order, $user, 'success');
                CartUtil::deleteCart();
                return redirect('/order-status/' . $orderId)->with('success', 'Your order has been placed');
            }
        }

        return view('frontend.checkout', $data);
    }

    public function orderStatus(Request $request, $orderId)
    {
        $data['order'] = Order::where('order_id', $orderId)->first();
        return view('frontend.order_status', $data);
    }

    public function paymentFetch(Request $request)
    {
        // echo '<pre>'; 
        $payment = Payment::fetch();

        // print_r(json_encode($payment['data']->toArray()));
        // $payment['data']['status'] = 'Failed';

        if ($payment['status'] && strtoupper($payment['data']['status']) == 'CAPTURED') {
            $txnId = $payment['data']['order_id'];

            if ($payment['data']['status'] == 'captured') {
            } else if ($payment['data']['status'] == 'failed') {
            }
            $txnStatus = 'SUCCESS';
            $orderStatus = 'PLACED';
        } else {
            $txnId = $payment['data']['order_id'];
            $txnStatus = strtoupper($payment['data']['status']);
            $orderStatus = 'CANCELLED';
        }

        $order = Order::where('txn_id', $txnId)->first();
        $order->txn_status = $txnStatus;
        $order->status = $orderStatus;
        $order->save();

        $txn = TxnHistory::where('txn_id', $txnId)->first();
        $txn->txn_data = json_encode($payment['data']->toArray());
        $txn->status = $txnStatus;
        $txn->save();

        CartUtil::deleteCart();

        $user = User::find(session('user')->id);
        if ($orderStatus === "PLACED") {
            $this->sendOrderMailToUser($order, $user, 'success');
        }
        return redirect('/order-status/' . $order->order_id);
    }

    public function cancelOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong'], 405);
        }
        $order = DB::table('orders')->where('order_id', $request->order_id)->where('user_id', session('user')->id)->first();
        if (!empty($order)) {
            DB::table('orders')->where('order_id', $request->order_id)->update([
                'status' => 'CANCELLED',
            ]);
            $user = User::find(session('user')->id);
            $this->sendOrderMailToUser($order, $user, 'cancelled');
            return response()->json(['message' => 'Your order has been cancelled.']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 405);
        }
    }

    public function checkCODAvailability(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pincode' => 'required|digits:6',
        ], [
            'pincode.required' => 'Please enter pincode',
            'pincode.digits' => 'Please enter vaild pincode',
        ]);

        if ($validator->fails()) {
            $errors = $this->error_processor($validator);
            $form_errors = $errors;
            // $data['form_data'] = $request->all();
            return response()->json(['messgae', 'Something went wrong', 'form_errors' => $form_errors], 405);
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://track.delhivery.com/c/api/pin-codes/json/?token=' . env('DELHIVERY_TOKEN') . '&filter_codes=' . $request->pincode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (!empty(json_decode($response)->delivery_codes[0]->postal_code->cod) && json_decode($response)->delivery_codes[0]->postal_code->cod == "Y") {
            return response()->json(['message' => 'COD available in your locality']);
        } else {
            return response()->json(['message', 'Something went wrong', 'form_errors' => ['pincode' => 'COD not available in your locality']], 405);
        }
    }

    public function sendOrderMailToUser($order, $user, $status)
    {
        if ($status == 'success') {
            $title = "Thank You For Your Order.";
            $message1 = "We are happy to let you know that we have received your order.";
            $message2 = "Woo hoo! Your order has been placed. Your order details can be found below.";
            $subject = 'Your Order has been placed';
        }

        if ($status == 'cancelled') {
            $title = "Your order has been cancelled.";
            $message1 = "We are unhappy that you have cancelled your order.";
            $message2 = "Your order has been cancelled. Your order details can be found below.";
            $subject = 'Your Order has been cancelled';
        }
        $orderItems = DB::table('order_items as t1')
            ->select('t1.*', 't2.item_name', 't2.combo_price', 't3.caption_name', DB::raw('(select thumb from products_images as t4 where t4.p_item_id=t1.item_id and t4.pid=t1.product_id limit 1) as product_image'))
            ->join('products_items as t2', 't2.id', 't1.item_id')
            ->join('products as t3', 't3.id', 't1.product_id')
            ->where('t1.order_id', $order->order_id)->get();
        // dd($orderItems);
        $orderItemsString = '';
        foreach ($orderItems as $orderItem) {
            $orderItemsString = $orderItemsString . '<a href="' . Url('product/' . $orderItem->item_id . '/' . Common::getSlugName($orderItem->caption_name)) . '" style="text-decoration: none;color:#000000;">
        <div style="border: 1px solid #eee;display: flex;margin-top: 20px;">
            <img style="width: 100px;height:100px;padding: 16px;"
                src="' . env('IMG_URL') . 'product_images/' . $orderItem->product_image . '" alt="' . $orderItem->caption_name . '">
            <div style="padding: 16px;">
                <h3 style="margin-top: 6px;margin: 0;">' . $orderItem->pname . '</h3>
                <small style="color: rgb(91, 91, 91);">' . $orderItem->item_name . '</small>
                <div style="margin-top: 8px;">
                <span style="color: #555555;">Qty:</span>
                <strong style="font-size:12px">' . $orderItem->qty . '</strong>
            </div>
                <div style="margin-top: 8px;">
                    <span style="color: #555555;">Price:</span>
                    <strong style="font-size:18px">&#8377;' . $orderItem->combo_price . '</strong>
                </div>
            </div>
        </div>
    </a>';
        }
        $email_templete =  '
    <div style="background:#3d787b;">
        <img style="max-height: 4rem;" src="https://easy-buy.in/default/easybuy_logo.webp" alt="easybuy">
        <a href="https://easy-buy.in"
            style="color:#eee;background: #728a8ca1;padding: 8px;border-radius: 4px;text-decoration: none;float: right;margin-top: 17px;margin-right:16px;">Shop
            Now</a>
    </div>
    <div style="padding:16px;max-width: 800px;margin: 0 auto; border: 1px solid #eee;">
        <h1 style="text-align:center;margin-bottom: 56px;margin-top: 24px;">' . $title . '</h1>
        <p>Hello ' . $user->fname . ',</p>
        <p>' . $message1 . '</p>
        <div>
            <div style="max-width: 400px; margin-bottom: 16px;">
                <strong>Delivery Information</strong>
                <div style="margin-top: 4px;">
                    ' . $order->shipping_address . '
                </div>
                <div style="margin-top: 4px;"><strong>Mobile:</strong> ' . $order->contact_number . '</div>
            </div>
        </div>
        <p>' . $message2 . '</p>
        ' . $orderItemsString . '
        <div style="margin-top:32px">
            <div style="margin-bottom: 8px;">
                <strong>Sub Total</strong>
                <span style="float:right">&#8377;' . $order->total_price . '</span>
            </div>
            <div style="margin-bottom: 8px;border-bottom: 2px solid #eee; padding-bottom: 8px;">
                <strong>Delivery Charges</strong>
                <span style="float:right">&#8377;' . $order->shipping_charges . '</span>
            </div>
            <div style="margin-bottom: 8px;">
                <strong>Total</strong>
                <span style="float:right">&#8377;' . $order->grand_total . '</span>
            </div>
        </div>
    </div>
    <div style="max-width: 868px;margin: 0 auto;background:#3d787b; padding:16px 0;text-align: center;">
        <img style="max-height: 4rem;" src="https://easy-buy.in/default/easybuy_logo.webp" alt="easybuy">
        <div style="color:#eee;margin: 0 8px;">' . Common::getAddress() . '
        </div>
        <div style="margin-top: 12px;">
            <div style="color: #eeeeee;margin-bottom: 8px;">Follow us:</div>
            <a href=""> <img style="max-width: 24px;margin-right: 4px;" src="https://easy-buy.in/default/facebook.png"
                    alt=""></a>
            <a href=""> <img style="max-width: 24px;margin-right: 4px;" src="https://easy-buy.in/default/ig.png"
                    alt=""></a>
            <a href=""> <img style="max-width: 24px;margin-right: 4px;" src="https://easy-buy.in/default/twitter.png"
                    alt=""></a>
            <a href=""> <img style="max-width: 24px;margin-right: 4px;" src="https://easy-buy.in/default/youtube.png"
                    alt=""></a>
        </div>
    </div>';

        $mailData = [
            'fromName' => 'Easybuy',
            'mailTo' => $user->email,
            'toName' => $user->fname,
            'content' => $email_templete,
            'subject' => $subject
        ];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('MAILER_URL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $mailData,
            CURLOPT_HTTPHEADER => array(
                'origin: http://localhost:3000'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
}
