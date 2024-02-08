<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Libs\CartUtil;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        // dd(DB::table('users')->get());
        if ($request->isMethod('post')) {
            // dd($request->all());
            $request->validate([
                'fullname' => 'required',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users',
                'mobile' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:users,phno',
                'password' => 'required|min:8',
            ], [
                'fullname.required' => 'Please enter your full name.',
                'email.required' => 'Please enter your email.',
                'email.regex' => 'Please enter vaild email.',
                'email.unique' => 'This email has already been taken.',
                'mobile.required' => 'Please enter your mobile number.',
                'mobile.regex' => 'Please enter vaild mobile number.',
                'mobile.unique' => 'Mobile number already registered.',
                'password.required' => 'Please enter your passowrd.',
                'password.min' => 'Password length atleast 8 long.',
            ]);
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

            $hashPass = Hash::make($request->password);


            try {

                $user = new User();
                $user->fname = $request->fullname;
                $user->email = $request->email;
                $user->phno = $request->mobile;
                $user->role = 'USER';
                $user->password = $hashPass;
                $user->save();

                return redirect('/')->with('success', 'You are succcessfully sign up, Now you can login.');

                // $data = [
                //     'fname' => $request->fullname,
                //     'email' => $request->email,
                //     'phno' => $request->mobile,
                //     'role' => 'USER',
                //     'password' => $hashPass,
                // ];
                // $id = DB::table('users')->insertGetId($data);
                // if (!empty($id)) {
                //     return view('frontend.home')->with('success', 'You are succcessfully sign up, Now you can login.');
                // } else {
                //     return back()->with('error', 'Something went wrong.');
                // }
            } catch (QueryException $e) {
                return back()->with('error', 'Something went wrong.');
            }
        }
        return view('frontend.auth.signup');
    }
    public function login(Request $request)
    {
    
        if ($request->isMethod('post')) {
           
            $request->validate([
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'password' => 'required|min:8',
            ]);

            $user = User::where('email', $request->email)->first();
           if(!$user){
                return back()->with('error', 'You have entered wrong email or password');
           }
            $authCheck = Hash::check($request->password, $user->password);

            if ($authCheck) {
                session(['user' => $user]);
                CartUtil::addCartDataToDB();
                CartUtil::getCartList();
                return redirect(session('last_url') ?? '/')->with('success', 'You are succcessfully logged in');
            }
        }
        return view('frontend.auth.login');
    }

    public function forgotPassword(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ],[
            'email.required' => 'Please enter email'
        ]);

        if ($validator->fails()) {
            $errors = $this->error_processor($validator);
            return response()->json(['form_errors' => $errors, 'form_data' => $request->all()], 400);
        }

        $payload = json_encode(
            [
                'email' => $request->email,
                'expired_at' => time()+(10*60)
            ]
            );

        $hash = Crypt::encryptString($payload);

        $url = url('reset-password/'. $hash);
        $obj = User::where('email',$request->email)->first();
        if(!empty($obj)){
            $content = '
            <div style="text-align:center;padding-top: 2rem;">
            <h2 style="text-align:center">Password reset link is below</h2>
            <p>Password link will be expired in 10 minutes</p>
                <a style="color:#ffffff;text-decoration:none;" href="'.$url.'">
                    <div style="width:fit-content;text-align:center;padding: 1rem;margin: 0 auto;background:#427c80;">CLICK HERE
                    </div>
                </a>
            </div>
            ';
            $data = array('replyTo' => $request->email,'fromName' => 'Easybuy','mailTo' => $request->email,'toName' => $obj->fname,'content' => $content,'subject' => 'Easybuy password reset link');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mailer.xtreebit.ml/api/sendmail',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'origin: '.Url('/')
            ),

        ));
            $response = curl_exec($curl);
            $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            curl_close($curl);
            if ($httpcode != 200) {
                return response()->json(['message'=> 'Something went wrong'],400);
            } 
        }
        return response()->json(['form_data' => $request->all(),'message'=> 'Password reset link sent successfully']);
    }

    public function resetPassword($hash){
        try {
            $decrypted = Crypt::decryptString($hash);
            $payload = json_decode($decrypted,1);
            // dd($payload,time());
            if(time() > $payload['expired_at'] ){
                abort(403,'Link expired');
            }
            else{
                return view('frontend.auth.reset_password');
            }
        } catch (DecryptException $e) {
            abort(500);
        }
    }

    public function resetPassword1(Request $request){
        try {
            $decrypted = Crypt::decryptString($request->hash);
            $payload = json_decode($decrypted,1);
            // dd($payload,time());
            if(time() > $payload['expired_at'] ){
                abort(403,'Link expired');
            }

            $validator = Validator::make($request->all(), [
                'new_password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'required|min:8',
            ], [
                'new_password.required' => 'Please enter new password.',
                'confirm_password.required' => 'Please enter confirm password.',
    
            ]);
    
            if ($validator->fails()) {
                $errors = $this->error_processor($validator);
                return back()->with(['form_errors' => $errors, 'form_data' => $request->all(), 'error' => 'Something went wrong, Please try again']);
            }
    
            User::where('email',$payload['email'])->update([
                'password' => Hash::make($request->new_password)
                ]
            );
            return redirect('/login')->with(['success' => 'Password successfully changed']);
        } catch (DecryptException $e) {
            abort(500);
        }
    }
}
