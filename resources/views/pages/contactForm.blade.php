@include('includes.header')


<!-- Main container -->
<main class="main-content">


    <section class="section pb-0">
        <div class="container">

            <h2 class="text-center">Contact Us</h2>

            <br><br>

            <form class="row gap-y" action="http://thetheme.io/thesaas/assets/php/sendmail.php" method="POST" data-form="mailer">
                <div class="col-12 col-lg-6">

                    <div class="alert alert-success">We received your message and will contact you back soon.</div>

                    <div class="row">
                        <div class="form-group col-12 col-md-6" style="padding: 0px 15px;">
                            <input class="form-control form-control-lg" type="text" name="firstname" placeholder="First Name">
                        </div>

                        <div class="form-group col-12 col-md-6" style="padding: 0px 15px;">
                            <input class="form-control form-control-lg" type="text" name="lastname" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12 col-md-6" style="padding: 0px 15px;">
                            <input class="form-control form-control-lg" type="email" name="email" placeholder="Email">
                        </div>

                        <div class="form-group col-12 col-md-6" style="padding: 0px 15px;">
                            <input class="form-control form-control-lg" type="text" name="phone" placeholder="Phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control form-control-lg" rows="4" placeholder="What do you have in mind?" name="message"></textarea>
                    </div>

                    <button class="btn btn-lg btn-primary" type="submit">Send message</button>

                </div>


                <div class="col-12 offset-lg-1 col-lg-5 text-center text-lg-left">
                    <h5>Seattle, WA</h5>
                    <p>2651 Main Street, Suit 124<br>Seattle, WA, 98101</p>
                    <p>+1 (321) 654 9870<br>+1 (987) 123 6548</p>
                    <p>hello@thetheme.io</p>
                    <h6>Follow Us</h6>
                    <div class="social social-sm">
                        <a class="social-twitter" href="https://twitter.com/4_slash"><i class="fa fa-twitter"></i></a>
                        <a class="social-facebook" href="https://www.facebook.com/4Slash"><i class="fa fa-facebook"></i></a>
                        <a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
                        <a class="social-dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                    </div>
                </div>
            </form>

        </div>

        <br><br><br><br>

        <div class="h-350" data-provide="map" data-lat="44.540" data-lng="-78.556" data-marker-lat="44.540" data-marker-lng="-78.556" data-info="&lt;strong&gt;Our office&lt;/strong&gt;&lt;br&gt;3652 Seventh Avenue, Los Angeles, CA" data-style="light"></div>

    </section>



</main>
<!-- END Main container -->


@include('includes.footer')