<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{


    public function myaccount(Request $request)
    {
        if ($request->isMethod('post')) {

            // $validator = Validator::make($request->all(), [
            //     'fullname' => 'required',
            //     'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
            //     'mobile' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:users,phno',
            //     'password' => 'required|min:8',
            // ], [
            //     'fullname.required' => 'Please enter your full name.',
            //     'email.required' => 'Please enter your email.',
            //     'email.regex' => 'Please enter vaild email.',
            //     'email.unique' => 'Email already registered.',
            //     'mobile.required' => 'Please enter your mobile number.',
            //     'mobile.regex' => 'Please enter vaild mobile number.',
            //     'mobile.unique' => 'Mobile number already registered.',
            //     'password.required' => 'Please enter your passowrd.',
            //     'password.min' => 'Password length atleast 8 long.',
            // ]);

            // if ($validator->fails()) {
            //     $errors = $this->error_processor($validator);
            //     // dd($errors);
            //     return back()->with('errors', $errors);
            // }

            $validator = Validator::make($request->all(), [
                'fullname' => 'required|min:8',
                'email' => 'required|unique:users,email,' . session('user')->id,
                'mobile' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:users,phno,' . session('user')->id,
                'profile_pic' => 'image',
            ], [
                'fullname.required' => 'Please enter full name.',
                'email.required' => 'Please enter email.',
                'mobile.required' => 'Please enter mobile.',
                'mobile.regex' => 'Please enter valid mobile number',
                'profile_pic.image' => 'Profile pic must be a image.',
            ]);

            if ($validator->fails()) {
                $errors = $this->error_processor($validator);
                return back()->with(['form_errors' => $errors, 'form_data' => $request->all(), 'error' => 'Something went wrong, Please try again']);
            }
            $user  = User::find(session('user')->id);
            // dd($user->profile_img);
            if ($request->file('profile_pic')) {
                $image = $request->file('profile_pic');
                $filename = 'profile-' . session('user')->id . '-' . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('data/profile_images');
                if (!empty($user->profile_img) &&  file_exists(public_path('data/profile_images') . '/' . $user->profile_img)) {
                    unlink($destinationPath . "/" . $user->profile_img);
                }
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(150, 150)->save($destinationPath . '/' . $filename);
                $user->profile_img = $filename;
            }

            $user->fname = $request->fullname;
            $user->email = $request->email;
            $user->phno = $request->mobile;
            $user->save();
            return redirect('/myaccount')->with('success', 'Profile updated successfully');
        }

        $user = User::find(session('user')->id);
        $default_address = Address::where('user_id', session('user')->id)->where('is_default', 1)->first();
        return view('frontend.user.myaccount', ['user' => $user, 'default_address' => $default_address]);
    }

    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:8',
        ], [
            'current_password.required' => 'Please enter current password.',
            'new_password.required' => 'Please enter new password.',
            'confirm_password.required' => 'Please enter confirm password.',

        ]);

        if ($validator->fails()) {
            $errors = $this->error_processor($validator);
            return back()->with(['form_errors' => $errors, 'form_data' => $request->all(), 'error' => 'Something went wrong, Please try again']);
        }

        $user = User::find(session('user')->id);
        $authCheck = Hash::check($request->current_password, $user->password);

        if (!$authCheck) {
            return redirect('/myaccount')->with(['form_data' => $request->all(), 'error' => 'Password does not verify']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/myaccount')->with(['success' => 'Password successfully changed']);
    }

    public function myorders()
    {
        $orders = DB::table('orders')
            ->where('user_id', session('user')->id)
            ->whereIn('status', ['PLACED', 'DISPATCHED', 'DELIVERED', 'CANCELLED'])
            ->latest()->limit(20)->get();
        return view('frontend.user.myorders', ['orders' => $orders]);
    }
}
