@extends('layouts.master')

@section('body-class', 'login-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-white fixed-top navbar-transparent')

@section('content')

<div class="page-header header-filter" filter-color="blue">
    <div class="page-header-image" style="background-image:url(../assets/img/login-bg.jpg)"></div>
    <div class="content">
        <div class="container">
            <div class="col-md-5 ml-auto mr-auto">
                <div class="card card-login card-plain">
                    <form class="form" id="reset_form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="card-header text-center">
                            <div class="logo-container">
                                <img src="{{ asset('assets/img/kooldoc-icon.png') }}" alt="">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group no-border input-lg">
                                <div class="input-group no-border input-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                                    </div>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="input-group no-border input-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="input-group no-border input-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                    </div>
                                    <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <ul class="pull-left">
                <li>
                    <a href="/terms-conditions" target="_blank">
                        Terms & Conditions
                    </a>
                </li>
                <li>
                    <a href="/privacy-policy" target="_blank">
                        Privacy Policy
                    </a>
                </li>
            </ul>
            <div class="copyright" id="copyright">
                &copy;
                <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script> Kooldoc All Rights Reserved.
            </div>
        </div>
    </footer>
</div>

@endsection
