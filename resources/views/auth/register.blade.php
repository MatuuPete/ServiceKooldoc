@extends('layouts.master')

@section('body-class', 'signup-page sidebar-collapse')

@section('nav-class', 'navbar navbar-expand-lg bg-primary navbar-absolute navbar-transparent')

@section('content')

<div class="page-header header-filter" filter-color="blue">
    <div class="page-header-image" style="background-image:url(../assets/img/register-bg.jpg)"></div>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                            <i class="now-ui-icons business_money-coins"></i>
                        </div>
                        <div class="description">
                            <h5 class="info-title">Service First Before Payment</h5>
                            <p class="description">
                                At Kooldoc, top-notch service comes first. Schedule an appointment and we'll make sure your aircon is in tip-top shape before payment.
                            </p>
                        </div>
                    </div>
                    <div class="info info-horizontal">
                        <div class="icon icon-primary">
                            <i class="now-ui-icons files_paper"></i>
                        </div>
                        <div class="description">
                            <h5 class="info-title">Free Consultation, Then Post-Consultation</h5>
                            <p class="description">
                                Our experienced professionals offer free expert advice and guidance to help you understand your aircon needs. We're here to support you even after the service is complete.
                            </p>
                        </div>
                    </div>
                    <div class="info info-horizontal">
                        <div class="icon icon-info">
                            <i class="now-ui-icons shopping_tag-content"></i>
                        </div>
                        <div class="description">
                            <h5 class="info-title">Warranty</h5>
                            <p class="description">
                                We stand behind our work with a warranty on all services. Our goal is your satisfaction, and our warranty shows our commitment to quality and customer satisfaction.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mr-auto">
                    <div class="card card-signup">
                        <div class="card-body">
                            <h4 class="card-title text-center">Register</h4>
                            <form class="form" id="register_form">
                                @csrf

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons text_caps-small"></i></span>
                                    </div>
                                    <input id="first_name" name="first_name" type="text" class="form-control" placeholder="First Name">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons text_caps-small"></i></span>
                                    </div>
                                    <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Last Name">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons ui-1_email-85"></i></span>
                                    </div>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons tech_mobile"></i></span>
                                    </div>
                                    <input id="phone" name="phone" type="text" class="form-control" value="+63" disabled>
                                    <input id="number" name="number" type="text" class="form-control" placeholder="Phone Number">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                    </div>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="now-ui-icons ui-1_lock-circle-open"></i></span>
                                    </div>
                                    <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input id="tc_check" class="form-check-input" type="checkbox">
                                        <span class="form-check-sign"></span>
                                        <a href="#" data-toggle="modal" data-target="#tcppModal">I agree to the terms and conditions</a>.
                                    </label>
                                </div>
                                <div class="card-footer text-center">
                                    <button id="register_btn" type="submit" class="btn btn-primary btn-round btn-lg" disabled >Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

<div class="modal fade" id="tcppModal" tabindex="-1" role="dialog" aria-labelledby="tcppModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                </button>
                <h4 class="title title-up">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>Welcome to KOOLDOC Air Conditioning Service Business. These terms and conditions govern your use of our services. By using our services, you agree to be bound by these terms and conditions. Please read them carefully before using our services.</p>
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
                <p>By using our services, you agree to be bound by these terms and conditions. If you have any questions or concerns, please do not hesitate to contact us. We look forward to serving you.</p>
            </div>
            <div class="modal-header justify-content-center">
                <h4 class="title title-up">Privacy Policy</h4>
            </div>
            <div class="modal-body">
                <p>KOOLDOC Air Conditioning Service Business (referred to as "we", "us", "our") respects your privacy and is committed to protecting your personal information. This privacy policy describes how we collect, use, and share information when you use our services.</p>
                <ol>
                    <li><strong>Information We Collect:</strong><br>We may collect personal information from you, such as your name, address, phone number, and email address when you use our services. We may also collect non-personal information such as your device's IP address, browser type, and operating system.</li><br>
                    <li><strong>How We Use Your Information:</strong><br>We may use your personal information to provide you with our services, communicate with you about our services, and improve our services. We may also use your non-personal information for statistical analysis, troubleshooting, and improving our website and services.</li><br>
                    <li><strong>Sharing Your Information:</strong><br>We may share your personal information with our employees and contractors who need access to the information to provide our services. We may also share your information with our trusted third-party partners who assist us in providing our services, such as payment processors and marketing partners. We will never sell your personal information to third parties.</li><br>
                    <li><strong>Security:</strong><br>We take appropriate measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. We implement industry-standard security measures such as encryption and password protection to safeguard your personal information.</li><br>
                    <li><strong>Cookies:</strong><br>We use cookies on our website to enhance your user experience and personalize your interactions with us. You can choose to disable cookies in your browser settings, but this may affect your ability to use our website.</li><br>
                    <li><strong>Third-Party Websites:</strong><br>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these websites. We encourage you to read the privacy policies of these websites before using them.</li><br>
                    <li><strong>Children's Privacy:</strong><br>Our services are not intended for children under the age of 13. We do not knowingly collect personal information from children under 13. If we learn that we have collected personal information from a child under 13, we will promptly delete the information.</li><br>
                    <li><strong>Changes to This Policy:</strong><br>We may update this privacy policy from time to time to reflect changes in our business practices or legal requirements. We will post the updated policy on our website and notify you of any significant changes.</li><br>
                </ol>
                <p>By using our services, you consent to the collection, use, and sharing of your personal information as described in this privacy policy. If you have any questions or concerns about our privacy policy, please contact us.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Decline</button>
                <button id="add_tcpp" type="button" class="btn btn-primary">Accept</button>
            </div>
        </div>
    </div>
</div>

<script> 

    document.getElementById("add_tcpp").addEventListener("click", function() {
        if (!document.getElementById("tc_check").checked) {
            document.getElementById("tc_check").checked = true;
            document.getElementById('register_btn').removeAttribute('disabled');
            $('#tcppModal').modal('hide');
        }
    });

    document.getElementById('tc_check').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('register_btn').removeAttribute('disabled');
        } else {
            document.getElementById('register_btn').setAttribute('disabled', true);
        }
    });
</script>

@endsection