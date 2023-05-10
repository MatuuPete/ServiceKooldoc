@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="pricing-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <h2 class="title">Pricing Quotation</h2>
                    <h4 class="description">Find the best price for your aircon booking needs based on the type of service and aircon you have. We offer competitive rates without compromising the quality of our service. </h4>
                    <h3 class="title">Price starts at...</h3>
                    <div class="section-space"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-pricing card-plain">
                        <div class="card-body">
                            <h5 class="category">Clean</h5>
                            <div class="icon icon-primary">
                                <i class="now-ui-icons objects_umbrella-13"></i>
                            </div>
                            <h3 class="card-title">
                                <small>Window - ₱666.99</small>
                            </h3>
                            <ul>
                                <li>Split - ₱888.99</li>
                                <li>Tower - ₱999.99</li>
                                <li>Cassette - ₱1111.99</li>
                                <li>Suspended - ₱1299.99</li>
                                <li>Concealed - ₱1499.99</li>
                                <li>U-Shaped Window - ₱1699.99</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-pricing" data-background-color="orange">
                        <div class="card-body">
                            <h5 class="category">Installation</h5>
                            <div class="icon icon-primary">
                                <i class="now-ui-icons objects_support-17"></i>
                            </div>
                            <h3 class="card-title">
                                <small>Window - ₱999.99</small>
                            </h3>
                            <ul>
                                <li>Split - ₱1299.99</li>
                                <li>Tower - ₱1499.99</li>
                                <li>Cassette - ₱1699.99</li>
                                <li>Suspended - ₱1899.99</li>
                                <li>Concealed - ₱2099.99</li>
                                <li>U-Shaped Window - ₱2299.99</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-pricing card-plain">
                        <div class="card-body">
                            <h5 class="category">Repair</h5>
                            <div class="icon icon-primary">
                                <i class="now-ui-icons ui-2_settings-90"></i>
                            </div>
                            <h3 class="card-title">
                                <small>Window - ₱1499.99</small>
                            </h3>
                            <ul>
                                <li>Split - ₱1999.99</li>
                                <li>Tower - ₱2199.99</li>
                                <li>Cassette - ₱2499.99</li>
                                <li>Suspended - ₱2799.99</li>
                                <li>Concealed - ₱2999.99</li>
                                <li>U-Shaped Window - ₱3199.99</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-pricing" data-background-color="orange">
                        <div class="card-body">
                            <h5 class="category">Maintenance</h5>
                            <div class="icon icon-primary">
                                <i class="now-ui-icons ui-1_settings-gear-63"></i>
                            </div>
                            <h3 class="card-title">
                                <small>Window - ₱2499.99</small>
                            </h3>
                            <ul>
                                <li>Split - ₱2999.99</li>
                                <li>Tower - ₱3299.99</li>
                                <li>Cassette - ₱3499.99</li>
                                <li>Suspended - ₱3999.99</li>
                                <li>Concealed - ₱4499.99</li>
                                <li>U-Shaped Window - ₱4999.99</li>
                            </ul>
                        </div>
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

@endsection