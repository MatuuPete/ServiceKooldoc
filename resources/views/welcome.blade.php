@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="section-space"></div>

    <div class="cd-section" id="home">
        <div class="header-1">
            <div class="page-header header-filter">
                <div class="page-header-image" style="background-image: url('assets/img/home-bg.jpg');"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 ml-auto text-right">
                            <h1 class="title">Kooldoc</h1>
                            <h4 class="description">Empowering life for a better living</h4>
                            <br />
                            <div class="buttons">
                                <a href="https://www.facebook.com/kooldocairconditioning" class="btn btn-icon btn-link btn-neutral btn-lg" target="_blank">
                                    <i class="fab fa-facebook-square text-info"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-link btn-neutral btn-lg">
                                    <i class="fab fa-instagram text-info"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-link btn-neutral btn-lg">
                                    <i class="fab fa-twitter text-info"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-link btn-neutral btn-lg">
                                    <i class="fab fa-youtube text-info"></i>
                                </a>
                                <a id="landing_book" href="/book-service" class="btn btn-info btn-lg mr-3">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-section" id="advertisement">
        <div class="features-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Advertisement</h2>
                        <h4 class="description">Kooldoc simplifies your air conditioning service bookings. With our user-friendly platform, you can easily book appointments online, connecting with experienced professionals who provide top-notch service. Say goodbye to the hassle of phone calls and emails and say hello to a seamless booking experience with Kooldoc.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        
                    </div>
                    <div class="col-md-8">
                        <div class="iframe-container">
                            <div class="iframe-container">
                                <iframe height="725" src="https://www.facebook.com/plugins/video.php?height=476&href=https%3A%2F%2Fwww.facebook.com%2Fkooldocairconditioning%2Fvideos%2F644270777348707%2F&show_text=false&width=476&t=0" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="separator-line separator-primary"></div>

    <div class="section" id="carousel">
        <div class="container">
            <div class="text-center">
                <h2 class="title">Highlights</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block" src="assets/img/carousel-img-1.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Kooldoc</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block" src="assets/img/carousel-img-2.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Clean</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block" src="assets/img/carousel-img-3.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Installation</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block" src="assets/img/carousel-img-4.jpg" alt="Fourth slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Repair</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block" src="assets/img/carousel-img-5.jpg" alt="Fifth slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Maintenance</h5>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <i class="now-ui-icons arrows-1_minimal-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <i class="now-ui-icons arrows-1_minimal-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-section" id="book">
        <div class="team-3 section-image" style="background-image: url('assets/img/book-bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Book A Service</h2>
                        <h4 class="description">With just a few clicks, you can easily schedule an appointment that suits your schedule.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-7 ml-auto mr-auto text-capitalize">
                        
                        <div class="owl-carousel owl-theme" id="technician-carousel"></div>
                        <h3 class="title text-center">Technicians</h3>
                    </div>
                    <div class="col-xl-6 col-lg-7 ml-auto mr-auto text-capitalize">
                        <div class="owl-carousel owl-theme" id="feedback-carousel"></div>
                        <h3 class="title text-center">Feedbacks</h3>
                    </div>
                    <div class="col-xl-6 col-lg-7 ml-auto mr-auto text-center">
                        <h4 class="description">Get the best service, for your HVAC system today!</h4>
                        <a id="home_book" href="/book-service" class="btn btn-primary btn-lg">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="about">
        <div class="projects-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">About Company</h2>
                        <h4 class="description">KOOLDOC originated from our co-founder's HVAC expertise for more than 30 years. Due to market demand and inquiries from the high-rise residential condominium & commercial segment we are stepping up to be officially a company with an experienced team to serve the customer needs on HVAC Services.</h4>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-5 ml-auto mt-5">
                        <div class="info info-horizontal">
                            <div class="icon icon-warning">
                                <i class="now-ui-icons shopping_delivery-fast"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Expert Aircon Service</h4>
                                <p class="description">
                                    Kooldoc delivers efficient and affordable aircon services
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-warning">
                                <i class="now-ui-icons gestures_tap-01"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Convenient Booking System</h4>
                                <p class="description">
                                    Online, easy and convenient. Book without hassle.
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-warning">
                                <i class="now-ui-icons education_glasses"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Customer-Oriented Experience</h4>
                                <p class="description">
                                    Personalized and reliable aircon services to meet your specific needs, ensuring your satisfaction.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mr-auto">
                        <div class="card card-background card-background-product card-raised" style="background-image: url('../assets/img/about.jpg')">
                            <div class="card-body">
                                <h2 class="card-title">Kooldoc</h2>
                                <p class="card-description text-white">
                                    Kooldoc: Innovative aircon service. Fast, efficient, and cost-effective solutions with the latest technology.
                                </p>
                                <label class="badge badge-neutral">HVAC Services</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-section" id="services">
        <div class="projects-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Key Products & Services</h2>
                        <p>KOOLDOC Offers the overall HVAC support from Installation, to Cleaning, to Maintenance and up to Repair. We will also have an upcoming aircon accessories that will give consumers better satisfaction.</p>
                        <div class="tab-content tab-space">
                            <div class="tab-pane active" id="pill1">
                            </div>
                            <div class="tab-pane" id="pill2">
                            </div>
                            <div class="tab-pane" id="pill3">
                            </div>
                            <div class="tab-pane" id="pill4">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 px-0">
                        <div class="card card-background card-background-product card-no-shadow" style="background-image: url('assets/img/clean.jpg')">
                            <div class="card-body">
                                <h3 class="card-title">Clean</h3>
                                <p class="card-description">
                                    Our aircon cleaning service is designed to improve the efficiency of your air conditioning unit and extend its lifespan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-0">
                        <div class="card card-raised card-background card-background-product card-no-shadow" style="background-image: url('assets/img/installation.jpg')">
                            <div class="card-body">
                                <h3 class="card-title">Installation</h3>
                                <p class="card-description">
                                    Expert and top-notch installation service of all types of air conditioners professional and reliable. Guaranteed satisfaction.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-0">
                        <div class="card card-background card-background-product card-no-shadow" style="background-image: url('assets/img/repair.jpg')">
                            <div class="card-body">
                                <h3 class="card-title">Repair</h3>
                                <p class="card-description">
                                    Expert for all types of aircon units repair service, fast diagnosis & efficient solutions. Trustworthy and reliable service.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-0">
                        <div class="card card-background card-background-product card-no-shadow" style="background-image: url('assets/img/maintenance.jpg')">
                            <div class="card-body">
                                <h3 class="card-title">Maintenance</h3>
                                <p class="card-description">
                                    Proactive maintenance to ensure optimal performance and longevity of your aircon units. Safe and best care for your unit.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-section" id="team">
        <div class="team-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Our Expert Team</h2>
                        <h4 class="description">Meet our dedicated and skilled team, ready to serve you.<br>Get to know our team!</h4>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4 ml-1">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <img class="img img-raised" src="{{ asset('assets/img/emman.jpg') }}" />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Emman Libres</h3>
                                <h6 class="category text-primary">Sales & Marketing Head</h6>
                                <p class="card-description">
                                    Leads strategy implementation for our products and services, exceeding business goals.
                                </p>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mr-1">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <img class="img img-raised" src="{{ asset('assets/img/manny.jpg') }}" />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Manny Libres</h3>
                                <h6 class="category text-primary">Technical Helpdesk Head</h6>
                                <p class="card-description">
                                    Oversees technical support team to provide timely assistance and continuously improve processes for high customer satisfaction.
                                </p>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ml-1 mt-4">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                    <img class="img img-raised" src="{{ asset('assets/img/gelo.jpg') }}" />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Gelo Santillan</h3>
                                <h6 class="category text-primary">Supply Chain Head</h6>
                                <p class="card-description">
                                    Ensure efficient and cost-effective flow of goods and services from suppliers to customers, builds supplier relationships for timely and cost-effective delivery.
                                </p>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mr-1 mt-4">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <img class="img img-raised" src="{{ asset('assets/img/ed.jpg') }}" />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Ed Dono</h3>
                                <h6 class="category text-primary">Operations Head</h6>
                                <p class="card-description">
                                    Oversees day-to-day operations, collaborating with other departments to achieve objectives. Ensures efficiency, productivity, and quality for customers.
                                </p>
                                <div class="card-footer">
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-facebook-square"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="btn btn-icon btn-primary btn-round"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ml-1 mt-4">
                        <div class="card card-profile card-plain">
                            <div class="card-avatar">
                                <img class="img img-raised" src="{{ asset('assets/img/caleb.jpg') }}" />
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Caleb Libres</h3>
                                <h6 class="category text-primary">Online Chat Support Head</h6>
                                <p class="card-description">
                                    Manages and leads our online chat support team, ensuring timely and effective customer assistance.
                                </p>
                                <div class="card-footer">
                                    <a href="#pablo" class="btn btn-icon btn-primary btn-round"><i class="fab fa-twitter"></i></a>
                                    <a href="#pablo" class="btn btn-icon btn-primary btn-round"><i class="fab fa-dribbble"></i></a>
                                    <a href="#pablo" class="btn btn-icon btn-primary btn-round"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cd-section" id="contact-us">
        <div class="contactus-1 section-image" style="background-image: url('assets/img/contact-us-bg.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h2 class="title">Get in Touch</h2>
                        <h4 class="description">With any questions, concerns or inquries.<br>Feel free to reach us! Kooldoc is always at your service.</h4>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                            <i class="now-ui-icons location_pin"></i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Find us at the store</h4>
                                <p class="description"> 11 Ballecer, Central Signal Village,
                                    <br> Taguig City,
                                    <br> Metro Manila
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                            <i class="now-ui-icons tech_mobile"></i>
                            </div>
                            <div class="description">
                            <h4 class="info-title">Give us a ring</h4>
                            <p class="description"> www.kooldocbusiness.com</a>
                                <br> +639672309357
                                <br> inquiries@kooldocservices.com
                            </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 ml-auto mr-auto">
                        <div class="card card-contact card-raised">
                            <form role="form" id="contact_form">
                                @csrf

                                <div class="card-header text-center">
                                    <h4 class="card-title">Contact Us</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 pr-2">
                                            <label>Full name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                                                </div>
                                                <input type="text" id="full_name" name="full_name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 pl-2">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="now-ui-icons tech_mobile"></i></span>
                                                    </div>
                                                    <input type="text" id="contact_number" name="contact_number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                                            </div>
                                            <input type="email" id="email" name="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="now-ui-icons text_caps-small"></i></span>
                                            </div>
                                            <input type="text" id="subject" name="subject" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Your message</label>
                                        <textarea name="inquiry" id="inquiry" name="inquiry" rows="6" class="form-control"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary btn-round pull-right">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="map" class="big-map"></div>

    <footer class="footer footer-big" data-background-color="blue">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <h5>KOOLDOC</h5>
                        <div class="social-feed text-justify">
                            <div class="feed-line">
                                <p>Kooldoc is an innovative technology startup that offers an online platform for booking of professional aircon service technicians easily and from anywhere.</p>
                            </div>
                            <div class="feed-line">
                                <p>Our goal is to make the process of getting aircon service as convenient as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h5>COMPANY</h5>
                        <ul class="links-vertical">
                            <li>
                                <a href="/.#about">
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="/mission-vision">
                                    Mission & Vision
                                </a>
                            </li>
                            <li>
                                <a href="/company-product-history">
                                    Company & Product History
                                </a>
                            </li>
                            <li>
                                <a href="/.#contact-us">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <h5>BUSINESS</h5>
                        <ul class="links-vertical">
                            <li>
                                <a href="/key-products-services">
                                    Key Products & Services
                                </a>
                            </li>
                            <li>
                                <a href="/pricing-quotation">
                                    Pricing Quotation
                                </a>
                            </li>
                            <li>
                                <a href="/ac-info">
                                    AC Information
                                </a>
                            </li>
                            <li>
                                <a href="/future-plan">
                                    Future Plan
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5>Follow Us On</h5>
                        <ul class="social-buttons">
                            <li>
                                <a href="https://www.facebook.com/kooldocairconditioning" class="btn btn-icon btn-neutral btn-twitter btn-round text-primary" target="_blank">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-icon btn-neutral btn-facebook btn-round text-primary">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-icon btn-neutral btn-dribbble btn-round text-primary">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-icon btn-neutral btn-google btn-round text-primary">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                        <br>
                        <br>
                        <br>
                        <h6><a href="/terms-conditions">Terms & Conditions</a></h6>
                        <h6><a href="/privacy-policy">Privacy Policy</a></h6>
                    </div>
                </div>
            </div>
            <hr />
            <div class="copyright">
                Copyright &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> 
                Kooldoc All Rights Reserved.
            </div>
        </div>
    </footer>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1Ijoiam9zaHVhbHVpcyIsImEiOiJja253bXYzdHYwZDI4Mm9wYm95ZDU2emtiIn0.2Rc6G-hSlmvPJ0BKYJ58TQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [121.060258, 14.511384],
            zoom: 12
        });
        
        var marker = new mapboxgl.Marker({color: 'blue'}).setLngLat([121.05954387035247, 14.511764689035978]).addTo(map);
    </script>
</div>

@endsection
