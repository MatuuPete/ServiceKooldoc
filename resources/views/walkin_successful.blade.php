@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')
<div class="wrapper">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="card col-md-10 mx-auto custom-my p-5 text-center shadow-lg">
                    <div>
                        <h1 class="text-primary">BOOKING SUCCESSFUL</h1>
                        <i class="fa fa-check-circle text-primary fa-5x mb-3"></i>
                        <p class="lead">Thank you for choosing Kooldoc!</p>
                        <a href="/walkin-service" class="btn btn-primary mt-3">DONE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer" data-background-color="blue">
    <div class="container">
        <ul class="pull-left">
            <li>
                <a href="/terms-conditions">
                    Terms & Conditions
                </a>
            </li>
            <li>
                <a href="/privacy-policy">
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

@endsection
