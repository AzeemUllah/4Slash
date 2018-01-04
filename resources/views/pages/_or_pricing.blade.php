@include('includes.header')


<div class="container">

    <div class="table-responsive">
        <div class="membership-pricing-table">
            <table>
                <tbody><tr>
                    <th></th>
                    <th class="plan-header plan-header-free">
                        <div class="pricing-plan-name">Simple Start
                        </div>
                        <div class="pricing-plan-price">
                            <span style="font-size: 15px;">Free Plan</span>
                        </div>
                    </th>
                    <th class="plan-header plan-header-blue">
                        <div class="pricing-plan-name">Essential</div>
                        <form action="store2" method="POST" id="store2form" style="margin-bottom: 0px;padding: 0px;">
                            <div class="pricing-plan-price priceplus" style="display: initial;color: white;">
                                150
                            </div>
                            <input type="hidden" name="essentialpack" value="150" id="essentialpackinput">
                            <input id="qty6" type="hidden" value="5" name="qty2" class="qty1" data-amount="30" style="width: 32%; height: 25px;"/>
                        </form>
                        <span style="font-size: 25px;">$</span>
                        <div class="pricing-plan-period">month</div>
                    </th>
                    <th class="plan-header plan-header-blue">
                        <div class="pricing-plan-name">Enterprise</div>
                        <form action="store3" method="POST" id="store3form" style="margin-bottom: 0px;">
                            <div class="pricing-plan-price priceplus2" style="display: initial;color: white;">
                                600
                            </div>
                            <input type="hidden" name="enterprisepack" value="600" id="enterprisepackinput">
                            <input id="qty7" type="hidden" value="20" name="qty3" class="qty1" data-amount="30" style="width: 32%; height: 25px;"/>

                        </form>
                        <span style="font-size: 25px;">$</span>
                        <div class="pricing-plan-period">Yearly</div>
                    </th>

                </tr>

                <tr>
                    <td></td>
<form action="App_selection" method="POST">
                    <td class="action-header">
                        <button class="btn btn-info" name="submit" type="submit">
                            Start Now
                        </button>
                    </td>
</form>


                    <td class="action-header">
                        <button type="submit"  class="btn btn-info" name="submit" id="store2formbtn">
                            Buy Now
                        </button>
                    </td>


                    <td class="action-header">
                        <button type="submit" class="btn btn-info" name="submit" id="store3formbtn">
                            Buy Now
                        </button>
                    </td>


                </tr>
                <tr>
                    <td>USERS:</td>
                    <td>For One user</td>

                    <td>
                        <img src="http://i.imgur.com/yOadS1c.png" id="minus2" width="20" height="20" class="minus" style="float: left"/>
                        <input id="qty2" type="text" value="5" name="qty2" class="qty" data-amount="30" style="width: 32%; height: 25px;"/>
                        <img id="add2" src="http://i.imgur.com/98cvZnj.png" width="20" height="20" class="add" style="float: right"/>
                    </td>

                    <td>
                        <img src="http://i.imgur.com/yOadS1c.png" id="minus3" width="20" height="20" class="minus1" style="float: left"/>
                        <input id="qty3" type="text" value="20" name="qty3" class="qty1" data-amount="30" style="width: 32%; height: 25px;"/>
                        <img id="add3" src="http://i.imgur.com/98cvZnj.png" width="20" height="20" class="add1" style="float: right"/>
                    </td>

                </tr>


                <tr>
                    <td>APPS INCLUDED:</td>
                    <td>Any 3 Apps</td>
                    <td>All Apps</td>
                    <td>All Apps</td>

                </tr>
                <tr>
                    <td>BILLING:</td>
                    <td>Free</td>
                    <td>Monthly</td>
                    <td>Monthly</td>

                </tr>
                <tr>
                    <td>IMPLEMENTATION SERVICES:</td>
                    <td>Self-Service</td>
                    <td>Self-Service</td>
                    <td>Self-Service</td>

                </tr>
                <tr>
                    <td>SUPPORT:</td>
                    <td>Emails</td>
                    <td>24 Hour Support</td>
                    <td>24 Hour Support</td>

                </tr>
                <tr>
                    <td>PLATFORMS AVAILABLE:</td>
                    <td>Web Access</td>
                    <td>Web Access/Mac/Windows</td>
                    <td>Web Access/Mac/Windows</td>

                </tr>
                <tr>
                    <td>FREE MOBILE APPS:</td>
                    <td><span class="icon-no fa fa-times"></span></td>
                    <td>Coming Soon</td>
                    <td>Coming Soon</td>

                </tr>
                <tr>
                    <td>AUTOMATIC BACKUPS:</td>
                    <td>1</td>
                    <td>Available</td>
                    <td>Available</td>

                </tr>
                <tr>
                    <td>DATA SECURITY:</td>
                    <td><span class="icon-no fa fa-check" style="color: dodgerblue"></span></td>
                    <td><span class="icon-no fa fa-check" style="color: dodgerblue"></span></td>
                    <td><span class="icon-no fa fa-check" style="color: dodgerblue"></span></td>

                </tr>
                </tbody></table>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 100px;">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-4">
                    <img src="img/contactmanager.png">
                </div>
                <div class="col-md-8">
                    <h3>Need a much simpler option</h3>

                    <p>Try our simple contact management solution that helps you manage contacts with ease.</p>
                    <button type="button" class="btn" style="background: white;border: 1px solid;color: black;">Try Sprout ContactManager</button>
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