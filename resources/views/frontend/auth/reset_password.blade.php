@extends('layouts.frontend')
@section('meta')
<title>Forgot Password | Easybuy Online Shopping Site In India</title>
<meta name="robots" content="noindex">
@endsection
@section('content')
    <!-- Ec login page -->
    <section class="ec-page-content section-space-p" style="max-width: 40rem; margin: 0px auto;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Reset Password</h2>
                        <h2 class="ec-title">Reset Password</h2>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                  
                    <div class="ec-login-container">
                        <div class="ec-login-form">
                            <form action="{{ Url('reset-password') }}" class="needs-validation" method="post" novalidate>
                                @csrf
                                <input type="hidden" name="hash" value="{{ Request::segment(2) }}">
                                <span class="ec-login-wrap mb-4">
                                    <label>Password*</label>
                                    <input class="form-control mb-0" type="password" name="new_password"
                                        placeholder="Enter your new password" required />
                                        @if (@session('form_errors')['new_password'])
                                        <div class="text-danger">
                                            {{ session('form_errors')['new_password'] }}
                                        </div>
                                        @endif
                                </span>
                                <span class="ec-login-wrap mb-4">
                                    <label>Password*</label>
                                    <input class="form-control mb-0" type="password" name="confirm_password"
                                        placeholder="Enter your confirm password" required />
                                        @if (@session('form_errors')['confirm_password'])
                                        <div class="text-danger">
                                            {{ session('form_errors')['confirm_password'] }}
                                        </div>
                                    @endif
                                </span>
                                <span class="ec-login-wrap ec-login-btn">
                                    <button class="btn btn-primary" type="submit">Reset</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
