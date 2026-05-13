@extends('layouts.main')
@section('title') Contacts @endsection

@section('content')
    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center">Contact Us</div>
        </div>
    </div>

    <div class="w-100 overflow-x-hidden">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d196237.18500521834!2d-86.2975570281474!3d39.77993181387909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886b50ffa7796a03%3A0xd68e9df640b9ea7c!2sIndianapolis%2C%20IN%2C%20USA!5e0!3m2!1sen!2scm!4v1735673543910!5m2!1sen!2scm" width="1920" height="1080" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <section class="flat-spacing-21">
        <div class="container">
            <div class="tf-grid-layout gap30 lg-col-2">
                <div class="tf-content-left">
                    <h5 class="mb_20">Visit Our Store</h5>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Address</strong></p>
                        <p>Address: 1234 Fashion Street, Suite 567,
                            Indianapolis, IN</p>
                    </div>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Phone</strong></p>
                        <p>(212) 934-2400</p>
                    </div>
                    <div class="mb_20">
                        <p class="mb_15"><strong>Email</strong></p>
                        <p>contact@sombos-creations.com</p>
                    </div>
                    <div class="mb_36">
                        <p class="mb_15"><strong>Open Time</strong></p>
                        <p>Mon - Sat: 9am to 6pm</p>
                    </div>
                    <div>
                        <ul class="tf-social-icon d-flex gap-20 style-default">
                            <li><a href="#" class="box-icon link round social-facebook border-line-black"><i class="icon fs-14 icon-fb"></i></a></li>
                            <li><a href="#" class="box-icon link round social-twiter border-line-black"><i class="icon fs-12 icon-Icon-x"></i></a></li>
                            <li><a href="#" class="box-icon link round social-instagram border-line-black"><i class="icon fs-14 icon-instagram"></i></a></li>
                            <li><a href="#" class="box-icon link round social-tiktok border-line-black"><i class="icon fs-14 icon-tiktok"></i></a></li>
                            <li><a href="#" class="box-icon link round social-pinterest border-line-black"><i class="icon fs-14 icon-pinterest-1"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="tf-content-right">
                    <h5 class="mb_20">Get in Touch</h5>
                    <p class="mb_24">If you’ve got great products your making or looking to work with us then drop us a line.</p>
                    <div>
                        <form class="form-contact" id="contactform" action="./contact/contact-process.php" method="post" novalidate="novalidate">
                            <div class="d-flex gap-15 mb_15">
                                <fieldset class="w-100">
                                    <input type="text" name="name" id="name" required="" placeholder="Name *">
                                </fieldset>
                                <fieldset class="w-100">
                                    <input type="email" name="email" id="email" required="" placeholder="Email *">
                                </fieldset>
                            </div>
                            <div class="mb_15">
                                <textarea placeholder="Message" name="message" id="message" required="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="send-wrap">
                                <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
