<?php

namespace App\Http\Controllers;

use App\Libs\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Address;

class AddressController extends Controller
{
    public function index()
    {
        $data['addresses'] = Address::where('user_id', session('user')->id)->get();
        return view('frontend.user.myaddress', $data);
    }

    public function addAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address1' => 'required',
            'address2' => 'required',
            'town_city' => 'required',
            'pincode' => 'required',
            'state' => 'required',
            'address_type' => 'required',
            'landmark' => 'required',
            'mobile' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
        ]);

        if ($validator->fails()) {
            $errors = $this->error_processor($validator);
            return response()->json(['form_errors' => $errors, 'form_data' => $request->all()], 400);
        }

        if (!empty($request->address_id)) {
            $obj = Address::where('id', $request->address_id)->first();
            if (!empty($obj) && $obj->user_id == session('user')->id) {
                Address::where('id', $request->address_id)->update([
                    'user_id' => session('user')->id,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'town_city' => $request->town_city,
                    'pincode' => $request->pincode,
                    'state' => $request->state,
                    'address_type' => $request->address_type,
                    'landmark' => $request->landmark,
                    'mobile' => $request->mobile,
                ]);
            } else {
                return response()->json(['message' => 'Something went wrong'], 400);
            }
            $data = Address::find($request->address_id);
            $data->stateName = Common::getStates()[(int)$data->state - 1]['name'];
            return response()->json(['message' => 'Address updated successfully', 'form_data' => $data]);
        }

        $addressId = Address::insertGetId([
            'user_id' => session('user')->id,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'town_city' => $request->town_city,
            'pincode' => $request->pincode,
            'state' => $request->state,
            'address_type' => $request->address_type,
            'landmark' => $request->landmark,
            'mobile' => $request->mobile,
            'created_at' => date('d-m-Y h:m:s'),
        ]);

        $data = Address::find($addressId);
        $data->stateName = Common::getStates()[(int)$data->state - 1]['name'];
        return response()->json(['message' => 'Address created successfully', 'form_data' => $data, 'states' => Common::getStates()]);
    }

    public function deleteAddress(Request $request)
    {
        $obj = Address::where('id', $request->id)->first();
        if (!empty($obj) && $obj->user_id == session('user')->id) {
            $obj = Address::select('is_default')->where('id', $request->id)->first();
            if ($obj->is_default == '1') {
                return response()->json(['message' => 'Default address can\'t be deleted'], 405);
            }
            Address::find($request->id)->delete();
            return response()->json(['message' => 'Address deleted successfully']);
        } else {
            return response()->json(['message' => 'Something went wrong'], 400);
        }
    }

    public function setDefaultAddress(Request $request)
    {
        Address::where('user_id', session('user')->id)->update(['is_default' => '0']);
        Address::where('id', $request->id)->update(['is_default' => '1']);
        return response()->json(['message' => 'Default address change successfully']);
    }
}
