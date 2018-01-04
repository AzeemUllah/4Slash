<div class="cnerr-footer-background-color">
    <div class="container mob-text-center">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a href="{{url()}}"><img src="{{ asset('img/bluelogo.png') }}" class="cnerr-footer-logo-margin"></a>
                <br>
                <br>
                <p>What do you need? On Cnerr you get it!</p>
                <p class="cnerr-copyright-class">Copyright &copy; 2017 <span class="cnerr-span-text-color-copy">Cnerr</span></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="cnerr-footer-category-margin-top heading-font">PAGES</h4>
                <ul class="footer-pages-list">
                    <li><a href="{{ route('userpackages') }}">Packages</a></li>  
                    <li><a href="#">Partner</a></li>
                    <li><a href="#">Impressum</a></li>
                    <li><a href="#">data protection</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="cnerr-footer-category-margin-top heading-font"></h4>
                <div class="fb-page" data-href="https://www.facebook.com/cnerr" data-width="280" data-height="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cnerr"><a href="https://www.facebook.com/cnerr">Cnerr</a></blockquote></div></div>
            </div> 
                         
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="cnerr-footer-category-margin-top heading-font"></h4>
                <a class="twitter-timeline" href="https://twitter.com/Cnerr_/likes" data-widget-id="672050447490924544">@Cnerr_'s Likes on Twitter</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>            </div>
        </div>
    </div>
</div>


<!--javascript-->


<script type="text/javascript" src="{{ asset('js/config.min.js') }}"></script>
<script src="{{ asset('js/jquery-2.2.4.min.js') }}" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jssor.slider.mini.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/star-rating.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/angular.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/sanitize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-slider.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-validation-1.14.0/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('script/app.min.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#formCustomOrder').validate({
            submitHandler: function(form) {
                MyJSLib.Ajaxifier.submitForm(form, 'Custom Order send successfully', 'Custom Order sending failed please try again');
                $(".gig-style").slideToggle();
            }

        });

        $(".btn-custom-gig").click(function(){
            $(".gig-style").slideToggle();  
        });


    });
</script>
