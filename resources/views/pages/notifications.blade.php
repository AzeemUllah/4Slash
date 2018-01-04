@include('includes.header')

<!-- Content -->
 
<div class="container Main">
  <h1>My Notifications</h1>
  <div class="notific">
     @foreach($notifications as $notification)
    <div class="row notify-list" style="border-bottom: 1px solid #c3c3c3; padding:30px 20px; margin:0px;">
      <div class="firs">
      <div class="col-md-1 col-sm-1" style="font-size:25px;">
        <span class="glyphicon glyphicon-remove-sign"></span>
      </div>
      <div class="col-md-1 col-sm-1">
        <img src="img\bell.png">
      </div>
      <div class="col-md-8 col-sm-8 not-txt">
        {{ $notification->message }}
      </div>
      <div class="col-md-2 col-sm-2 not-time">
        Today 18:35
      </div>
      </div>
    </div>
      @endforeach
  </div>
</div>



        @include('includes.footer')

    </body>
</html>
