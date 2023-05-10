@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="cd-section">
        <div class="features-6">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">APK</h2>
                        <h4 class="description">Kooldoc has got you covered. Download our app now and experience hassle-free aircon maintenance and repair services at your fingertips!</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="now-ui-icons education_agenda-bookmark"></i>
                            </div>
                            <div class="description">
                                <h5 class="info-title">Service Booking</h5>
                                <p>Book aircon services on-the-go with our mobile app. Experience the convenience of scheduling appointments and managing your bookings with ease.</p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="now-ui-icons design_bullet-list-67"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Appointment Management</h4>
                                <p>Easily schedule, reschedule, and track your aircon service appointments with our mobile app. Keep all your appointments organized in one place and stay on top of your HVAC maintenance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="phone-container text-center">
                            <img src="{{ asset('assets/img/mobile-app-img.jpg') }}" />
                            <a href="{{ asset('public/mobile_app/kooldocv1.apk') }}" class="btn btn-primary btn-round" type="button">Download</a>
                            <p><a href="#" onclick="copyLink()">Copy Link</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="now-ui-icons ui-2_like"></i>
                            </div>
                            <div class="description">
                                <h5 class="info-title">Customer Feedback</h5>
                                <p>Improve your aircon booking service with customer feedback. Our easy-to-use system lets you gather thoughts and opinions to enhance their experience.</p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="now-ui-icons ui-2_chat-round"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Customer Support</h4>
                                <p>Get exceptional customer support for your aircon booking service with our mobile app. Our team is always ready to assist you and ensure you have the best possible experience.</p>
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

<script>
    function copyLink() {
        var link = "https://kooldocbusiness.com/public/mobile_app/kooldocv1.apk";
        navigator.clipboard.writeText(link);
        alert("Link copied to clipboard!");
    }
</script>

@endsection