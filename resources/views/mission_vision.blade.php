@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="section">
        <div class="blogs-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto">
                        <h2 class="title">Mission & Vision</h2>
                        <br />
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card card-plain card-blog">
                                    <div class="card-image">
                                        <img class="img img-raised rounded" src="{{ asset('assets/img/mission-vision.png') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-body">
                                        <h6 class="category text-info">Company Mission</h6>
                                        <h5 class="card-title">
                                            Our Mission Statement
                                        </h5>
                                        <p class="card-description text-justify">
                                            Give HVAC customers the most out of their air conditioner while avoiding unexpected equipment failure. We advocate for the urbanization of the household to create a convenient and safe neighborhood.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card card-plain card-blog">
                                    <div class="card-body">
                                        <h6 class="category text-info">Company Vision</h6>
                                        <h5 class="card-title">
                                            Our Vision Statement
                                        </h5>
                                        <p class="card-description text-justify">
                                            To offer HVAC Services in the direct-to-consumer sector that are both high quality and convenient.
                                        </p>
                                    </div>
                                </div>
                            </div>
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