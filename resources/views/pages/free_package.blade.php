@include('includes.header')


<form action="{{ route('free_package_form') }}" method="POST">
<div class="container" style="text-align: center; margin-bottom: 400px;">

    <div class="col-md-12 col-sm-12 col-xs-12 modulesheading" style="margin-bottom: 27px;">
        <h2 style="text-align: center;font-size: 52px;">Choose Your Apps</h2>
        <h5 style="text-align: center">Using Any Three Apps is FREE for One user</h5>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 startbutt" style="margin-bottom: 30px;">
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2" style="margin-bottom: 15px;">
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account.png" /></span><span style="font-size: 13px;">Purchases</span></a>
                
                <input class="modulecheckboxes"  name="apps[]" type="checkbox" value="purchase" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account_accountant.png"></span><span style="font-size: 13px;">Fleets</span></a>
                <input class="modulecheckboxes"  name="apps[]"  type="checkbox" value="fleets" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
                <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Sales</span></a>
                <input class="modulecheckboxes" name="apps[]"   type="checkbox" value="sales" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
            </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Repairs</span></a>
            <input class="modulecheckboxes"  name="apps[]" value="repairs" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2" style="margin-bottom: 15px; ">

        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account.png"/></span><span style="font-size: 13px;">Contacts</span></a>
            <input class="modulecheckboxes" name="apps[]" value="Contacts"  type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account_accountant.png"></span><span style="font-size: 13px;">Mass Mailing</span></a>
            <input class="modulecheckboxes" name="apps[]" value="mass mailing" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Timesheets</span></a>
            <input class="modulecheckboxes" name="apps[]" value="timesheet" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Project</span></a>
            <input class="modulecheckboxes" name="apps[]" value="projects" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2" style="margin-bottom: 15px; ">

        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account.png"/></span><span style="font-size: 13px;">Point of Sale</span></a>
            <input class="modulecheckboxes" name="apps[]" value="pointofsale" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account_accountant.png"></span><span style="font-size: 13px;">Attendance</span></a>
            <input class="modulecheckboxes" name="apps[]" value="attendance" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Employees</span></a>
            <input class="modulecheckboxes" name="apps[]" value="employees" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Dashboard</span></a>
            <input class="modulecheckboxes" name="apps[]" value="dashboards" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2" style="margin-bottom: 15px; ">

        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account.png"/></span><span style="font-size: 13px;">Recruitment</span></a>
            <input class="modulecheckboxes" name="apps[]" value="recruitment" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account_accountant.png"></span><span style="font-size: 13px;">Discuss</span></a>
            <input class="modulecheckboxes" name="apps[]" value="discuss"  type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style=" font-size: 13px;">Accounting</span></a>
            <input class="modulecheckboxes" name="apps[]" value="accounting" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;">Maintenance</span></a>
            <input class="modulecheckboxes" name="apps[]" value="maintenance" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-2" style="margin-bottom: 15px; ">

        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account.png"/></span><span style="font-size: 13px;">Inventory</span></a>
            <input class="modulecheckboxes inventory" name="apps[]" value="inventory" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"><img src="img/imagesmodule/account_accountant.png"></span><span style="font-size: 13px;">Expenses</span></a>
            <input class="modulecheckboxes" name="apps[]" type="checkbox" value="expenses" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span ><span style="font-size: 13px;">Manufacturing</span></a>
            <input class="modulecheckboxes manufacturing" name="apps[]" value="manufacturing" type="checkbox" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a href="" style="display: inline-grid;"><span style="display: inline-grid;font-size: 17px;"> <img src="img/imagesmodule/helpdesk.png"/></span><span style="font-size: 13px;"> Leaves</span></a>
            <input class="modulecheckboxes" name="apps[]" type="checkbox" value="leaves" style="margin-left: -14px;margin-bottom: 2px;position: absolute;" >
        </div>
    </div>

</div>
</form>





@include('includes.footer')

{{--<script>--}}

    {{--$('.gig-favourite-heart-icn').click(function (e) {--}}

        {{--e.preventDefault();--}}
        {{--$selectedGig = $(this).parent();--}}

        {{--var gigId = $selectedGig.data('coll-id');--}}
        {{--var url = $selectedGig.data('url');--}}

        {{--// var className = $('span.favorite-span > i').attr('class');--}}

        {{--//  alert(className);--}}

        {{--if ($(this).find('i').attr('class') == 'fa fa-heart') {--}}
            {{--var action = 'removeFavorite';--}}
            {{--$(this).empty().html('<span class="favorite-span"><i class="fa fa-heart-o"></i></span>');--}}
        {{--}--}}
        {{--else {--}}
            {{--var action = 'addToFavorite';--}}
            {{--$(this).empty().html('<span class="favorite-span"><i class="fa fa-heart"></i></span>');--}}
        {{--}--}}


        {{--$.ajax({--}}
            {{--url: url,--}}
            {{--method: 'POST',--}}
            {{--data: {'gig-id': gigId, 'action': action},--}}
            {{--success: function (data) {--}}
                {{--console.log(data);--}}

            {{--}--}}
        {{--});--}}
    {{--});--}}


{{--</script>--}}
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
        $('.gig-item-default').hover(function(){
            $(this).children('#sold').show();
        },function(){
            $(this).children('#sold').hide();
        });
        $('#custom_offer').click(function(){

            $(".gig-style").toggle();
        });
        var limit = 4;
        $('input.modulecheckboxes').on('click', function(evt) {
            if($('.modulecheckboxes:checked').length >= limit) {
                this.checked = true;
                return false;
            }

        });
    });
</script>





        <script>

            $('.single-checkbox').on('change', function() {
                if($('.single-checkbox:checked').length > 2) {
                    this.checked = false;
                }
            });

            $('.single-checkbox2').on('change', function() {
                if($('.single-checkbox2:checked').length > 1) {
                    this.checked = false;
                }
            });


        </script>


<script>

    $('#submit').prop("disabled", true);
    $(document.body).on('click','input:checkbox',function () {

            if ($('.modulecheckboxes').filter(':checked').length >= 3) {
                $('.startbutt').html(" <button type='submit' id='submit' name='submit' class='btn btn-danger' style='background: rgba(0, 185, 255, 0.95);border-color: rgba(0, 185, 255, 0.95);'>Start Now</button>");
            } else if ($('.modulecheckboxes:checked').size() < 3) {
                $("#submit").hide();
                console.log($('.modulecheckboxes:checked').size());


            }

    });



    {{--$('input:checkbox').click(function() {--}}
        {{--if ($(this).is(':checked')) {--}}
            {{--if ($('.modulecheckboxes').filter(':checked').length >= 3) {--}}
                {{--$('.startbutt').html("<a href='{{ route('free_package_form') }}'> <button type='submit' id='submit' name='submit' class='btn btn-danger' style='background: rgba(0, 185, 255, 0.95);border-color: rgba(0, 185, 255, 0.95);'>Start Now</button></a>");--}}
            {{--} else if ($('.modulecheckboxes:checked').size() < 3) {--}}
                {{--$("#submit").hide();--}}
                {{--console.log($('.modulecheckboxes:checked').size());--}}


            {{--}--}}
        {{--}--}}
    {{--});--}}

</script>

<script>
    $(document).ready(function () {
        $(document.body).on('click','.manufacturing', function () {

            if ($('.manufacturing').is(":checked")) {
                $('.inventory').prop('checked', true);
                console.log('checked');
            } else {
                $('.inventory').prop('checked', false);
                console.log('unchecked');
            }

        })

    });

</script>

</body>
</html>