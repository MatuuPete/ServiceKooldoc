@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="section">
        <div class="blogs-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">KEY PRODUCTS</h2>
                        <br />
                        <div class="card card-plain card-blog">
                            <div class="card-image">
                                <img class="img img-raised rounded" src="{{ asset('assets/img/key-products-services.png') }}" />
                            </div>
                            <h6 class="category text-info">Key Products Pie Chart</h6>
                            <h3 class="card-title">
                                Comprehensive HVAC Services
                            </h3>
                            <h5 class="card-description">
                                KOOLDOC Offers the overall HVAC support from Installation, to Maintenance and up to Repair. We will also have an upcoming aircon accessories that will give consumers better satisfaction.
                            </h5>
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