

<div class="cnerr-footer-background-color">
    <div class="container mob-text-center">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <a href="#"><img src="{{ asset('img/bluelogo.png') }}" class="cnerr-footer-logo-margin"></a>
                <br>
                <br>
                <p>What do you need? On 4slash you get it!</p>
                <p class="cnerr-copyright-class">Copyright 2016 &copy; <span class="cnerr-span-text-color-copy">Cnerr</span></p>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="cnerr-footer-category-margin-top heading-font">PAGES</h4>
                <ul class="footer-pages-list">
                    {{--<li><a href="{{ route('userpackages') }}">Pakete</a></li>--}}
                    <li><a href="#">Partner</a></li>
                    <li><a href="#">imprint</a></li>
                    <li><a href="#">data protection</a></li>  
                    <li><a href="#">Help</a></li>
                    <li><a href="#">contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="cnerr-footer-category-margin-top heading-font"></h4>
                <div class="fb-page" data-href="https://www.facebook.com/cnerr" data-tabs="timeline" data-height="313px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cnerr"><a href="https://www.facebook.com/cnerr">Cnerr</a></blockquote>         
                 </div>
               </div>
            </div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <h4 class="cnerr-footer-category-margin-top heading-font"></h4>
                <a class="twitter-timeline" href="https://twitter.com/Cnerr_/likes" data-widget-id="672050447490924544">@Cnerr_'s Likes on Twitter</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
        </div>
    </div>
</div>



<!--javascript-->


<script type="text/javascript" src="{{ asset('js/config.js') }}"></script>
<script type="text/javascript" src="{{ asset('code.jquery.com/ui/1.11.4/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jssor.slider.mini.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/star-rating.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/angular.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/angular/sanitize.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('node_modules/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-validation-1.14.0/dist/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('script/app.js') }}"></script>


<script type="text/javascript">
    $('.btn-custom-gig').click(function(){
        var container = $('.gig-style');
        container.slideToggle();
        $('.glyphicon-menu-down').toggle();
        $('.glyphicon-menu-up').toggle();
    });
    $(document).mouseup(function (e)
    {
        var container = $('.toggle-pane');

        if (!container.is(e.target) // if the target of the click isn't the container...
                && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.gig-style').slideUp();
            $('.glyphicon-menu-up').hide();
            $('.glyphicon-menu-down').show();

        }
    });
</script>


<script type="text/javascript">

    document.querySelector('.header-notify a').addEventListener('click', function(e) {
        $('.header-notify .notify-menu .antiscroll-wrap').html('<ul class="loading"></ul>');

        $.ajax({

            url: '/userNotifications',
            method:'get',
            success: function(data)
            {
                var notify = ''

                data.forEach(function(not)
                {
                    console.log(not.seen);
                    if(not.seen == 0)
                    {
                        notify += '<li style="font-weight: bold; padding: 15px;">'+ not.message +'</li>'
                    }
                    else {

                        notify += '<li>' +not.message + '<li>'
                    }
                });
                $('.header-notify .notify-menu .antiscroll-wrap').html(notify);
            },

        });

    })

</script>

