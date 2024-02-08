<?php
namespace App\Libs;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Payment
{
    //
    public static function make($arr)
    {

        /*
        $arr array(
        'receipt' => '',
        'amount' => '',
        'currency' => '',
        'merchant_order_id' => '',
        'name' => '',
        'email' => '',
        'contact' => '',
        );
        */

        // require($_SERVER['DOCUMENT_ROOT'] . '/razorpay/razorpay-php/Razorpay.php');

            /*text mode key
        $keyId = 'rzp_test_AcQxFhVvUdXA1d';
        $keySecret = '0vE5wwG8gAdfDlSt1Vy1cdOs';
        $displayCurrency = 'INR'; */

            /* live key */
        $keyId = env('RP_KEYID');
        $keySecret = env('RP_SECRET');
        $displayCurrency = 'INR';

            //error_reporting(E_ALL);
            //ini_set('display_errors', 1);

        $api = new Api($keyId, $keySecret);

        //
        // We create an razorpay order using orders api
        // Docs: https://docs.razorpay.com/docs/orders
        //
        $orderData = [
            // 'receipt'         => $arr['receipt'],
            'amount'          => $arr['amount'] * 100, // 2000 rupees in paise
            'currency'        => $arr['currency'] ?? 'INR',
            'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        $razorpayOrderId = $razorpayOrder['id'];

        // session(['razorpay_order_id' => $razorpayOrderId]);

        $displayAmount = $amount = $orderData['amount'];

        if ($displayCurrency !== 'INR') {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);

            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
        }

            /* $checkout = 'automatic';

        if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
        {
        $checkout = $_GET['checkout'];
        } */

        $data = [
            "key"               => $keyId,
            "amount"            => $amount,
            "name"              => "Easybuy",
            "description"       => $arr['description'] ?? 'Payment',
            "image"             => env('IMG_URL')."/site/logo-icon.png",
            "prefill"           => [
                // "name"              => $arr['name'],
                "email"             => $arr['email'],
                "contact"           => $arr['contact'],
            ],
            "notes"             => [
                "address"           => "",
                "merchant_order_id" => $arr['merchant_order_id'],
            ],
            "theme"             => [
                "color"             => "#427c80"
            ],
            "order_id"          => $razorpayOrderId,
        ];

        if ($displayCurrency !== 'INR') {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
        }

        $json = json_encode($data);

            //require("checkout/{$checkout}.php");
            $form = '<form id="razor_pay_form" action="' . $arr['success'] . '" method="POST">
            <input type="hidden" name="_token" value="'.csrf_token() .'">
        <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="' . $data['key'] . '"
        data-amount="' . $data['amount'] . '"
        data-currency="INR"
        data-buttontext="Submit"
        data-name="' . $data['name'] . '"
        data-image="' . $data['image'] . '"
        data-description="' . $data['description'] . '"
        data-prefill.email="' . $data['prefill']['email'] . '"
        data-prefill.contact="' . $data['prefill']['contact'] . '"
        data-theme.color="'.$data['theme']['color'].'"
        data-order_id="' . $data['order_id'] . '"
        data-notes.merchant_order_id="'.$data['notes']['merchant_order_id'].'"
        ' . (($displayCurrency !== "INR") ? "data-display_amount='.{$data['display_amount']}.'" : "") . '
        ' . (($displayCurrency !== "INR") ? "data-display_currency='.{$data['display_currency']}.'" : "") . '></script>
        </form>
        <style>.razorpay-payment-button{ display:none; }</style>
        <script>(function(){
            setTimeout(function(){ document.getElementsByClassName("razorpay-payment-button")[0].click(); },500);
        })();</script>
        ';

            /* data-notes.shopping_order_id="3456"
            data-prefill.name="' . $data['prefill']['name'] . '"
        <input type="hidden" name="shopping_order_id" value="3456"> */
        echo $form;
        return $data;
}

public static function fetch($razorpay_order_id = null, $razorpay_payment_id = null, $razorpay_signature = null)
{

    // require($_SERVER['DOCUMENT_ROOT'] . '/razorpay/razorpay-php/Razorpay.php');

    $keyId = env('RP_KEYID');
    $keySecret = env('RP_SECRET');

    $success = true;
    $result = NULL;

    $error = "Payment Failed";

    if (empty($_POST['razorpay_payment_id']) === false) {
        $api = new Api($keyId, $keySecret);

        try {
            // Please note that the razorpay order ID must
            // come from a trusted source (session here, but
            // could be database or something else)
            $attributes = array(
                'razorpay_order_id' =>  $razorpay_order_id ?? $_POST['razorpay_order_id'],
                'razorpay_payment_id' => $razorpay_payment_id ?? $_POST['razorpay_payment_id'],
                'razorpay_signature' => $razorpay_signature ?? $_POST['razorpay_signature']
            );

            $api->utility->verifyPaymentSignature($attributes);
        } catch (SignatureVerificationError $e) {
            $success = false;
            $error = 'Razorpay Error : ' . $e->getMessage();
        }
    }

    if ($success === true) {
        $id = $_POST['razorpay_payment_id'];

        $payment  = $api->payment->fetch($id); // Returns a particular payment
        //$payment  = $api->payment->fetch($id)->capture(array('amount'=>$amount)); // Captures a payment

        // $payment_obj['txn_id'] = $payment->id;
        // $payment_obj['status'] = ($payment->status == 'authorized') ? 'success' : $payment->status;
        // $payment_obj['entity'] = $payment->entity;
        // $payment_obj['amount'] = substr((string) $payment->amount, 0, strlen($payment->amount) - 2) . '.' . substr((string) $payment->amount, strlen($payment->amount) - 2, strlen($payment->amount));
        // $payment_obj['currency'] = $payment->currency;
        // $payment_obj['international'] = $payment->international;
        // $payment_obj['method'] = $payment->method;
        // $payment_obj['card_id'] = $payment->card_id;
        // $payment_obj['email'] = $payment->email;
        // $payment_obj['contact'] = $payment->contact;
        // $payment_obj['fee'] = $payment->fee;
        // $payment_obj['tax'] = $payment->tax;
        // $payment_obj['error_code'] = $payment->error_code;
        // $payment_obj['error_description'] = $payment->error_description;
        // $payment_obj['order_id'] = $payment->order_id;
        // $payment_obj['description'] = $payment->description;
        // $payment_obj['date_created'] = date("Y-m-d H:i:s", $payment->created_at);
        // $payment_obj['notes'] = $payment['notes'];

        $payment['amount'] = substr((string) $payment->amount, 0, strlen($payment->amount) - 2) . '.' . substr((string) $payment->amount, strlen($payment->amount) - 2, strlen($payment->amount));
        $payment['attributes']  = array(
            'razorpay_order_id' =>  $razorpay_order_id ?? $_POST['razorpay_order_id'],
            'razorpay_payment_id' => $razorpay_payment_id ?? $_POST['razorpay_payment_id'],
            'razorpay_signature' => $razorpay_signature ?? $_POST['razorpay_signature']
        );

        $result = array(
            'status' => TRUE,
            'data' => $payment,
            'error' => NULL,
        );
    } else {
        $result = array(
            'status' => FALSE,
            'data' => NULL,
            'error' => $error,
        );
    }

    return $result;
}
}
