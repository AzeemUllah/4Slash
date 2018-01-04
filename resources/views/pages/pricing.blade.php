@include('includes.header')


<div class="container">
    <div class="row gap-y text-center">
        <div class="col-md-12" style="padding-top: 85px;">

            <div class="col-md-4">
                <div class="pricing-1" style="text-align: center;">
                    <p class="plan-name">Simple Start</p>
                    <br>
                    <h2 class="price">Free Plan</h2>
                    <br>

                    <small>For One user</small><br>
                    <small>Any 3 Apps</small><br>
                    <small>Free</small><br>
                    <small>Self-Service</small><br>
                    <small>Emails</small><br>
                    <small>Web Access</small><br>
                    <i class="fa fa-times" aria-hidden="true"></i><br>
                    <small>1</small><br>
                    <i class="fa fa-check" aria-hidden="true"></i><br>
                    <p class="text-center py-3"><a class="btn btn-primary" href="#">Start Now</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-1" style="text-align: center;">
                    <p class="plan-name">Essential</p>
                    <br>
                    <h2 class="price text-success"><span class="price-unit">$</span> 39</h2>
                    <br>

                    <small>All Apps</small><br>
                    <small>Monthly</small><br>
                    <small>Self-Service</small><br>
                    <small>24 Hour Support</small><br>
                    <small>Web Access/Mac/Windows</small><br>
                    <small>Coming Soon</small><br>
                    <small>Available</small><br>
                    <small>Self-Service</small><br>
                    <i class="fa fa-check" aria-hidden="true"></i><br>
                    <p class="text-center py-3"><a class="btn btn-success" href="#">Buy Now</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-1" style="text-align: center;">
                    <p class="plan-name">Essential</p>
                    <br>
                    <h2 class="price text-success"><span class="price-unit">$</span> 39</h2>
                    <br>

                    <small>All Apps</small><br>
                    <small>Monthly</small><br>
                    <small>Self-Service</small><br>
                    <small>24 Hour Support</small><br>
                    <small>Web Access/Mac/Windows</small><br>
                    <small>Coming Soon</small><br>
                    <small>Available</small><br>
                    <small>Self-Service</small><br>
                    <i class="fa fa-check" aria-hidden="true"></i><br>
                    <p class="text-center py-3"><a class="btn btn-success" href="#">Buy Now</a></p>
                </div>
            </div>
        </div>
    </div>
</div>







@include('includes.footer')

<script>

    $('.gig-favourite-heart-icn').click(function (e) {

        e.preventDefault();
        $selectedGig = $(this).parent();

        var gigId = $selectedGig.data('coll-id');
        var url = $selectedGig.data('url');

        // var className = $('span.favorite-span > i').attr('class');

        //  alert(className);

        if ($(this).find('i').attr('class') == 'fa fa-heart') {
            var action = 'removeFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o"></i></span>');
        }
        else {
            var action = 'addToFavorite';
            $(this).empty().html('<span class="favorite-span"><i class="fa fa-heart"></i></span>');
        }


        $.ajax({
            url: url,
            method: 'POST',
            data: {'gig-id': gigId, 'action': action},
            success: function (data) {
                console.log(data);

            }
        });
    });


</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*$('.gig-item-default').hover(function(){
         $(this).children('.col-xs-5').removeClass('hover-transition');
         },function(){
         $(this).children('.col-xs-5').addClass('hover-transition');
         });
         $('.gig-item-default').hover(function(){
         $(this).children('.col-xs-4').removeClass('hover-transition');
         },function(){
         $(this).children('.col-xs-4').addClass('hover-transition');
         });*/
        $('.gig-item-default').hover(function () {
            $(this).children('#sold').show();
        }, function () {
            $(this).children('#sold').hide();
        });
        $('#custom_offer').click(function () {

            $(".gig-style").toggle();
        });
    });
</script>

{{--<script>--}}

{{--$(function () {--}}
{{--$(document.body).on('click','.add',function(){--}}
{{--var $qty=$(this).closest('td').find('.qty');--}}
{{--var currentVal = $qty.val();--}}

{{--console.log(currentVal);--}}

{{--if (currentVal >= 5 && total >= 5 && total < 20 ) {--}}
{{--$qty.val(++total);--}}
{{--}--}}
{{--});--}}
{{--});--}}


{{--$(document.body).on('click','.minus',function(){--}}
{{--var $qty=$(this).closest('td').find('.qty');--}}
{{--var currentVal = $qty.val();--}}

{{--console.log(currentVal);--}}

{{--if (currentVal > 5 && total > 5 && total <= 20 ) {--}}
{{--$qty.val(--total);--}}
{{--}--}}
{{--});--}}
{{--});--}}


{{--</script>--}}



<script>
    $(function () {
        var total = 5;
        $(document.body).on('click','.add',function(){
            var $qty=$(this).closest('td').find('.qty');
            var currentVal = $qty.val();

            console.log(currentVal);

            if (currentVal >= 5 && total >= 5 && total < 20) {
                $qty.val(total++);
                $('#qty6').val(total++);
            }
        });


        $(document.body).on('click','.minus',function(){
            var $qty=$(this).closest('td').find('.qty');
            var currentVal = $qty.val();

            console.log(currentVal);

            if (currentVal > 5 && total > 5 && total <= 20 ) {
                $qty.val(--total);
                $('#qty6').val(--total);

            }
        });
    });
</script>



<script>
    $(function () {
        var total = 20;
        $(document.body).on('click','.add1',function(){
            var $qty=$(this).closest('td').find('.qty1');
            var currentVal = $qty.val();

            console.log(currentVal);

            if (currentVal >= 20 && total >= 20 && total < 50) {
                $qty.val(total++);
                $('#qty7').val(total++);
            }
        });


        $(document.body).on('click','.minus1',function(){
            var $qty=$(this).closest('td').find('.qty1');
            var currentVal = $qty.val();

            console.log(currentVal);

            if (currentVal > 20 && total > 20 && total <= 50 ) {
                $qty.val(--total);
                $('#qty7').val(--total);
            }
        });
    });
</script>



<script>
    var addition = 30;
    $('#add2').click(function(){
        var currentVal =parseInt($('.priceplus').text());
        currentVal = currentVal+30;
        if(currentVal == 600){
            return false;
        }

        $('.priceplus').text(currentVal);
        $('#essentialpackinput').val(currentVal);


    });

    var multiplication = 30;
    $('#minus2').click(function(){
        var currentVal =parseInt($('.priceplus').text());
        currentVal = currentVal-30;
        if(currentVal == 150){
            return true;
        }
        $('.priceplus').text(currentVal);
        $('#essentialpackinput').val(currentVal);


    });

</script>



<script>
    var addition1 = 30;
    $('#add3').click(function(){
        var currentVal =parseInt($('.priceplus2').text());
        currentVal = currentVal+30;
        if(currentVal == 1500){
            return false;
        }

        $('.priceplus2').text(currentVal);
        $('#enterprisepackinput').val(currentVal)


    });

    var multiplication1 = 30;
    $('#minus3').click(function(){
        var currentVal =parseInt($('.priceplus2').text());
        currentVal = currentVal-30;
        if(currentVal == 600){
            return true;
        }
        $('.priceplus2').text(currentVal);
        $('#enterprisepackinput').val(currentVal)


    });


    $('#store2formbtn').on('click',function(){
        $('#store2form').trigger('submit');

    });

    $('#store3formbtn').on('click',function(){
        $('#store3form').trigger('submit');

    });

</script>



</body>
</html>