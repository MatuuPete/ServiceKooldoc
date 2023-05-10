@extends('layouts.master')

@section('body-class', 'sections-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary fixed-top')

@section('content')

<div class="wrapper">
    <div class="section">
        <div>
            <div class="container text-justify">
                <div class="row">
                    <div class="col-md-12 ml-auto mr-auto">
                        <h3 class="title">Terms & Conditions</h3>
                        <p>Welcome to KOOLDOC Air Conditioning Service Business. These terms and conditions govern your use of our services. By using our services, you agree to be bound by these terms and conditions. Please read them carefully before using our services.</p>
                        <p>
                            <ol>
                                <li><strong>Home Service:</strong><br>We offer home service for air conditioning needs to provide you with the convenience of having your AC serviced without leaving your home.</li><br>
                                <li><strong>Service before Payment:</strong><br>At KOOLDOC, we believe in providing quality services to our customers. Therefore, we offer our services before payment. We will conduct the necessary repairs or maintenance on your air conditioning unit and will only request payment once you are satisfied with our work.</li><br>
                                <li><strong>Verified User Account:</strong><br>You must have a verified user account to book our services. You will be required to provide personal information and contact details to create your account.</li><br>
                                <li><strong>15 Days Warranty Service:</strong><br>Our services come with a 15-day warranty period from the date of service. If you experience any issues related to the service provided during this period, we will provide a free of charge follow-up service to resolve the issue.</li><br>
                                <li><strong>Customer Feedback and Review:</strong><br>You are welcome to post feedback and reviews of our services on our website or our social media pages. We value your feedback and use it to improve our services.</li><br>
                                <li><strong>Posting of Completed Service in SNS:</strong><br>We may take pictures or videos of the completed service and post it on our social media pages or website for promotional purposes.</li><br>
                                <li><strong>Cancellation of Service:</strong><br>You may cancel your scheduled service at any time before the day of the scheduled service. However, we may charge a cancellation fee if the cancellation is made after our team has been dispatched to your location.</li><br>
                                <li><strong>Free Consultations and Inquiries:</strong><br>We offer free consultations and inquiries to help you with any questions or concerns you may have about your air conditioning unit. Our team of experts is available to assist you and provide recommendations to improve the efficiency of your unit. You may contact us through our website or social media pages to discuss your air conditioning needs.</li><br>
                                <li><strong>Modes of Payment:</strong><br>We accept cash or online payments through GCash for our services.</li><br>
                                <li><strong>Voucher Codes for Discounted Fees:</strong><br>We may offer voucher codes for discounted fees for our services. These voucher codes are subject to terms and conditions and may have an expiry date.</li><br>
                                <li><strong>Liability:</strong><br>While we take all necessary precautions to ensure the safety of our employees and your property, KOOLDOC Air Conditioning Service Business will not be liable for any damage to your property, loss of business, or any other losses resulting from our services.</li><br>
                                <li><strong>Confidentiality:</strong><br>We will treat all information about you and your property as confidential and will not disclose it to any third party without your consent, except as required by law.</li><br>
                                <li><strong>Applicable Law:</strong><br>These terms and conditions are governed by the laws of the jurisdiction in which we operate. Any disputes arising from our services will be resolved through the appropriate legal channels in that jurisdiction.</li><br>
                            </ol>
                        </p>
                        <p>By using our services, you agree to be bound by these terms and conditions. If you have any questions or concerns, please do not hesitate to contact us. We look forward to serving you.</p>
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