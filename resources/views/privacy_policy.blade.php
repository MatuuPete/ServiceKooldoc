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
                        <h3 class="title">Privacy Policy</h3>
                        <p>KOOLDOC Air Conditioning Service Business (referred to as "we", "us", "our") respects your privacy and is committed to protecting your personal information. This privacy policy describes how we collect, use, and share information when you use our services.</p>
                        <p>
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
                        </p>
                        <p>By using our services, you consent to the collection, use, and sharing of your personal information as described in this privacy policy. If you have any questions or concerns about our privacy policy, please contact us.</p>
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