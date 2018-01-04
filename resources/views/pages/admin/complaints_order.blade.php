@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Orders Complaints</h1>

@endsection




@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                        <tr>

                            <th>Order No</th>
                            <th>Complaint</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order_complaints as $complaints)
                                    <tr>
                                        <td>{{ $complaints->order_no }}</td>
                                        <td>{{ $complaints->complaint }}</td>
                                        <td>{{ $complaints->created_at }}</td>
                                        <td>
                                            @if($complaints->status == 0)
                                                <button type="button" class="btn btn-danger btn-xs slv_cmplnt" data-id="{{ $complaints->id }}" data-toggle="modal"
                                                        data-target="#myModal1">Problem lösen</button>
                                            @else
                                                {{ $complaints->rslvd_txt }}
                                            @endif
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <!-- Modal -->
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" id="snd_compl">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel1">solution</h4>
                    </div>
                    <div class="modal-body">
                        <textarea name="resolve_txt" id="resolve_txt" cols="30" rows="6" class="form-control"></textarea>
                        <input type="hidden" name="complaint_id" id="complaint_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary cnerr_btn slv_cmplnt_txt">Geslöst</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('pages_css')

    <!-- DataTables -->

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

@endsection





@section('pages_script')

    <!-- DataTables -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script type="text/javascript">
        $(function () {
            var table = $("#example1").DataTable({
                "aaSorting": [],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                iDisplayLength: -1
            });
            var table = $("#example2").DataTable({
                "aaSorting": [],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                iDisplayLength: -1
            });
            $(".slv_cmplnt").on("click",function(){
                var id = $(this).data('id');
                $("#complaint_id").val(id);
            });
            $(".slv_cmplnt_txt").on("click",function(){
                var resolve_txt = $("#resolve_txt").val();
                var button = $(".slv_cmplnt");
                var id = $("#complaint_id").val();
                $.ajax({
                    method : "post",
                    url    : "{{ route('orders.resolved') }}",
                    data   : {id: id,text : resolve_txt},
                    success : function(data){
                        if(data == 1){
                            $("#myModal1").modal('hide');
                        }else{
                            alert("some error occured!");
                        }
                    }
                })
            })
        })
    </script>

@endsection