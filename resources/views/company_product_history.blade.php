@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="section">
        <div class="blogs-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 ml-auto mr-auto text-justify">
                        <h2 class="title">Company Product & History</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-blog">
                                    <div class="card-body">
                                        <h6 class="category text-primary">Our Journey So Far</h6>
                                        <h5 class="card-title">
                                            Key Milestone
                                        </h5>
                                        <p class="card-description">
                                            KOOLDOC started in the Philippines last Q4 2020 from an aircon home service side hustle. This Q1 2022, we have already built a team that will provide more immense service scopes to customers.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-blog">
                                    <div class="card-body">
                                        <h6 class="category text-primary">Expertise</h6>
                                        <h5 class="card-title">
                                            Awards
                                        </h5>
                                        <p class="card-description">
                                            The KOOLDOC team is made up of experts in customer service and technical fields related to construction and building maintenance.
                                            <br>
                                            <br>
                                            <br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-blog">
                                    <div class="card-body">
                                        <h6 class="category text-primary">Service Areas</h6>
                                        <h5 class="card-title">
                                            Operations
                                        </h5>
                                        <p class="card-description">
                                            KOOLDOC is currently operating at Metro Manila and some part southern area such as Cavite, Laguna. Our online chat support team is readily available to serve our clients.
                                            <br>
                                            <br>
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