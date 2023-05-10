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
                        <h2 class="title">Future Plan</h2>
                        <br />
                        <div class="card card-plain card-blog">
                            <div class="card-image">
                                <img class="img img-raised rounded" src="{{ asset('assets/img/future-plan.png') }}" />
                            </div>
                            <h6 class="category text-info">API Accesories</h6>
                            <h3 class="card-title">
                                Expanding Our Product Line
                            </h3>
                            <h5 class="card-description">
                                KOOLDOC is aiming to improve customer experience and currently exploring the Aircon Accesories Market especially API accesories.
                            </h5>
                            <br />
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('assets/img/sensibo.jpg') }}" style="height: 40px; width: 125px;" alt="Image 1">
                                </div>
                                <div class="col-3">
                                    <img src="{{ asset('assets/img/ambiclimate.jpg') }}" style="height: 40px; width: 125px;" alt="Image 2">
                                </div>
                                <div class="col-3">
                                    <img src="{{ asset('assets/img/amazon.jpg') }}" style="height: 40px; width: 125px;" alt="Image 3">
                                </div>
                                <div class="col-3">
                                    <img src="{{ asset('assets/img/googleapi.jpg') }}" style="height: 40px; width: 125px;" alt="Image 4">
                                </div>
                            </div>
                            <h5 class="card-description">
                                Above brands are currently under exploration and will be launched soon!
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