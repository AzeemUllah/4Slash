<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?php echo base_url(); ?>img/ziprelay-favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/rating-style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/rating-example.css">


    <title>Welcome To Ziprelay</title>


    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">


    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/z_custom.css" rel="stylesheet">
    <style>
        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 80%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>

    <section>

        <div class="container">
            <div class="row step3-mar-top">

                <div class="col-lg-12 col-md-12 col-sm-12" id="load_status">
                    <?php echo $messages; ?>
                    <div class="row">
                        <form method="post" action="" id="order-msg-form">
                            <div class="col-lg-12 c-l-md-12 col-sm-12 " id="text-area">
                                <div class="textarea-div-bg message-text-area-margin">
                                    <textarea  name="message" class="form-control" rows="5" placeholder="Click here to send a message..." id="message"></textarea>
                                </div>
                                <button name="messageSend" type="submit" class="btn textarea-send-btn pull-right">SEND</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <script type="text/javascript" src="<?php echo base_url(); ?>js/helper_functions.js"></script>

    <script src="<?php echo base_url(); ?>js/workstream.js"></script>

    <script>
        (function() {

            document.querySelector('#order-msg-form').addEventListener('submit', function(evt) {
                evt.preventDefault();
                sendOrderMessage('<?php echo $order->order_number; ?>');
            });

        })();
    </script>

    <script>
        $('.star-1').click(function(){
            $('.star-2, .star-3, .star-4, .star-5').
        })
    </script>

    <script>


        function submitFeedback() {


            var feedback = $('#feedback').val();

            if (feedback == '') {
                alert('Required field');
                return false;
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>index.php/users/feedback',
                    data: 'feedback='+feedback+'&toUser=touser=<?php echo $toUser; ?>',
                    // beforeSend: function(){ },
                    success: function(result){
                        if(result == '1'){
                            $('.feedback').empty().html('<p>Thank you! Your feedback has been sent</p>');
                        }
                    }
                });
            }

            return false;

        }

        // rating script
        $(function(){
            $('.rate-btn').hover(function(){
                $('.rate-btn').removeClass('rate-btn-hover');
                var therate = $(this).attr('id');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-hover');
                };
            });


            $('.rate-btn').click(function(){
                var therate = $(this).attr('id');
                var dataRate = 'act=rate&touser=<?php echo $toUser; ?>&rate='+therate; //
                $('.rate-btn').removeClass('rate-btn-active');
                for (var i = therate; i >= 0; i--) {
                    $('.rate-btn-'+i).addClass('rate-btn-active');
                };

                $.ajax({
                    type : "POST",
                    url : "<?php echo base_url(); ?>index.php/users/ratings",
                    data: dataRate,
                    beforeSend: function() { $('#btn-preloader').show(); },
                    success:function(result){
                        if(result == '1'){
                            $('.rating').hide();
                            $('.feedback').slideDown();
                        }
                    },
                    complete: function(){ $('#btn-preloader').hide(); }
                });

            });
        });

    </script>

    <script>
        $(document).ready(function(){
            $('#refund-btn').click(function(){

                $.ajax({
                    type: 'post',
                    url: "<?php echo base_url(); ?>index.php/home/refundRequest",
                    success: function(result)
                    {
                        if(result == '1'){
                            window.location.reload(true);
                        }
                        else{
                            alert('request already sent');
                        }
                    }

                });
            });

            $('#cancel').click(function(){

                $.ajax({
                    type: 'post',
                    url: '<?php echo base_url(); ?>index.php/home/cancelrefund',
                    success: function(result){
                        if(result == '1'){
                            window.location.reload(true);
                        }
                        else{
                            alert('request already sent');
                        }
                    }
                })
            });
        })
    </script>

</body>
</html>