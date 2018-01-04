@extends('pages.admin.admin_template')


@section('header_title')
    @if(!$update)
        <h1>Create a new Favor</h1>
    @else
        <h1>Update Favor</h1>
    @endif

@endsection

<style>
    /* .gig-images-box-body img{
         width:120px;
         flaot:left;
         margin-right:5px;
     }*/
</style>


@section('content')

    @if(!$update)
        <form method="post" enctype="multipart/form-data" id="gig_submit" class="gig-submit">
            @else
                <form action="{{ route('gig.update') }}" method="post" enctype="multipart/form-data" id="gig-submit">
                    <input type="hidden" name="gig-id" value="{{ ($update) ? $gig->id : '' }}">
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">

                                <div class="box-body">
                                    @if($update)
                                    <div class="form-group form-inline">
                                        <label for="">Create by:</label>
                                        <span>{{  $user->username }}</span>
                                    </div>
                                    @endif
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input value="{{ ($update) ? $gig->title : '' }}" name="gig-title" type="text"
                                                   class="form-control" placeholder="Enter Gig Title..." required maxlength="50">
                                        <span>(Maximum 50 characters)</span>
                                    </div>


                                    {{--<div class="form-group">
                                        <label>Short Discription</label>
                                        <input value="{{ ($update) ? $gig->short_discription : '' }}"
                                               name="gig-short-discription"
                                               type="text" class="form-control"
                                               placeholder="Enter Gig Short Discription..." required>
                                    </div>--}}


                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Discription (Was Sie bekommen / What you get) <span style="color:#b299a5; font-weight: 500;">Please explain in a few words what the client buys. (Maximum 800 characters)</span></label>
                                        {{--<textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                                  placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>--}}

                                        <textarea id="editor1" name="gig-discription" rows="10" cols="80"
                                                  placeholder="Enter Gig Discription..." required>
                                            {{ ($update) ? $gig->discription : '' }}
                    </textarea>

                                    </div>
                                        <!-- textarea2 -->
                                        <div class="form-group">
                                            <label>Discription (Was wir benötigen / What we need) <span style="color:#b299a5; font-weight: 500;">Please explain in a few words what the client need's to send you (Maximum 800 characters)</span></label>
                                            {{--<textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                                      placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>--}}

                                            <textarea id="editor2" name="gig-discription1" rows="10" cols="80"
                                                      placeholder="Enter Gig Discription..." required>
                                            {{ ($update) ? $gig->discription2 : '' }}
                    </textarea>
                                        </div>
                                        <!-- textarea3 -->
                                        {{--<div class="form-group">
                                            <label>Discription (Erweiterungen (Aufpreis) / Extensions & Extras) <span style="color:#b299a5; font-weight: 500;">Please explain in a few words what extras you are offering (Maximum 800 characters)</span></label>
                                            --}}{{--<textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                                      placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>--}}{{--

                                            <textarea id="editor3" name="gig-discription2" rows="10" cols="80"
                                                      placeholder="Enter Gig Discription..." required>
                                            {{ ($update) ? $gig->discription3 : '' }}
                    </textarea>

                                        </div>--}}
                                        <div class="form-group">
                                            <label for="">Embed Video for favor <span style="color:#b299a5; font-weight: 500;">Place your one video embeded code here</span></label>
                                            <textarea class="form-control" name="videos" id="embed_video" cols="30" rows="5"
                                                      placeholder="Place your video embed code here..">{{ ($update) ? $gig->gig_videos : ''}}</textarea>
                                        </div>

                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select id="categorySelectList" name="gig-category" class="form-control"
                                                required data-url="{{ route('admin.category.subcategories') }}">
                                            {{--@if($update)
                                                <option value="{{$category->id}}" selected >{{$category->name}}</option>
                                            @else--}}
                                            <option value="">Select category</option>
                                            {{--@endif--}}
                                            @foreach($categories as $category)
                                                <option {{ ($update) ? (($category->id == $gig->gigtype_id) ? 'selected' : '') : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- select -->
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <p class="error" style="color:red;"></p>
                                            <label class="btn btn-primary btn-xs pull-right" for="subcat"  data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span></label>
                                            <div id="subcat_tagsinput" class="subcatinput" style="width: auto;">
                                                @if($update)
                                                    @foreach($subcategory as $subcat)
                                                <span class="subcat_span">
                                                    <input type="hidden" value="{{$subcat->id}}" name="gig-sub-category[]" class="single_id">
                                                    <span>{{$subcat->name}}&nbsp;&nbsp;</span>
                                                    <a href="" title="Removing Sub Category" class="remove-subcat">x</a>
                                                </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                    <!-- select -->
                                    <div class="row">

                                        <div class="col-md-6 form-group">
                                            <label>Delivery Days</label>
                                            <select name="gig-delivery-days" class="form-control" required>
                                                @for($i = 1; $i <= 30; $i++)
                                                    <option {{ (($update) ? (($gig->delivery_days == $i) ? 'selected' : '') : '') }} value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>


                                        <div class="col-md-6 form-group">
                                            <div class="col-xs-12">
                                                <label>Price</label>
                                            </div>
                                            {{--<div class="input-group">
                                                <span class="input-group-addon">&euro;</span>
                                                <input value="{{ (($update) ? $gig->price : '10') }}"
                                                       name="gig-price" type="number"
                                                       class="form-control" readonly>
                                                <span class="input-group-addon">.00</span>
                                                @if($errors->has('gig-price'))
                                                    <span class="help-block"
                                                          style="color:#ff0000">{{ $errors->first('gig-price') }}</span>
                                                @endif
                                            </div>--}}
                                            <div class="col-xs-9" style="padding: 0px;">
                                                <select name="gig-price" class="form-control">
                                                    @for($i = 10; $i <= 100; $i+=10)
                                                        <option {{ (($update) ? (($gig->price == $i) ? 'selected' : '') : '') }} value="{{ $i }}" {{ ($i == 10) ? 'selected':'' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-xs-3" style="padding: 0px;">
                                                <span class="input-group-addon form-control">.00</span>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info gig-images-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><span><img src="/img/img_thumnail.png" alt="" style="width: 50px; margin-right:10px;"></span> Images (750x350)</h3>
                                    <input style="position:absolute;top:0px;left:0px;width:0.1px;height:0.1px;opacity:0;overflow:hidden;"
                                           name="gig-images[]" accept="image/*" type="file" multiple id="fileee">
                                    <label class="btn btn-primary btn-xs pull-right" for="fileee"><span
                                                class="fa fa-plus"></span></label>
                                </div>
                                <div class="box-body gig-images-box-body">
                                    {{--@if($update)--}}
                                    @if(!empty($gigImages) && count($gigImages) > 0)
                                        @foreach($gigImages as $gigImage)
                                            {{-- {{ json_encode($gigImage)}}--}}
                                            @if(!empty($gigImage))
                                                <div style="position:relative;display:inline-block;">

                                                    {{--@if(file_exists('/files/gigs/images'. '/' . $gigImage->image))--}}
                                                    <button data-href="{{ route('gig.images.remove') }}"
                                                            data-image-id="{{  $gigImage->id }}"
                                                            style="position:absolute;right:0px;top:0px;padding:0px 6px;"
                                                            class="btn btn-default btn-gig-img-remove">x
                                                    </button>
                                                    <img style="height:60px;"
                                                         src="{{ url('/files/gigs/images') . '/' . $gigImage->image }}">
                                                    {{-- @endif--}}
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="box-footer"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info addons-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Addons</h3>
                                    <button type="button" id="add-new-addon"
                                            class="btn btn-primary btn-xs pull-right"><span
                                                class="fa fa-plus"></span></button>
                                </div>
                                <div class="box-body">
                                    @if($update)
                                        <?php $i = 1; ?>
                                        @foreach($gigAddons as $gigAddon)
                                            <div class="row">
                                                <div class="{{ ($gigAddon->addon == "Express Delivery")? 'col-md-5' :'col-md-6' }}">
                                                    <div class="form-group">
                                                        <input value="{{ $gigAddon->addon }}"
                                                               name="gig-addon[{{ $i }}][discription]" type="text"
                                                               class="form-control {{ ($gigAddon->addon == "Express Delivery")? 'express' :'' }}"
                                                               placeholder="Enter Addon Discription...">
                                                        <input value="{{ $gigAddon->id }}"
                                                               name="gig-addon[{{ $i }}][addon_id]" type="hidden"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                                <div class="{{ ($gigAddon->addon == "Express Delivery")? 'col-md-4' :'col-md-5' }}">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">&euro;</span>
                                                            <input value="{{ $gigAddon->amount }}"
                                                                   name="gig-addon[{{ $i }}][price]"
                                                                   type="number" class="form-control">
                                                            <span class="input-group-addon">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($gigAddon->addon == "Express Delivery")
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Days</span>
                                                                <input type="number" value="{{ $gigAddon->day }}" name="gig-addon[{{ $i }}][delivery_day]"
                                                                       class="form-control">
                                                                <input value="{{ $gigAddon->id }}"
                                                                       name="gig-addon[{{ $i }}][addon_id]" type="hidden"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-1 del-btn-box">
                                                    <button data-href="{{ route('gig-adon-remove') }}" type="button"
                                                            data-addonid="{{ $gigAddon->id }}"
                                                            class="btn btn-danger btn-xs remove-addon"><span
                                                                class="fa fa-minus"></span></button>
                                                </div>
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach
                                    @else
                                        {{--<div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <input value="Gewerbliche Nutzung"
                                                           name="gig-addon[2][discription]" type="text"
                                                           class="form-control"
                                                           placeholder="Enter Addon Discription...">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">&euro;</span>
                                                        <input value="50" name="gig-addon[2][price]"
                                                               type="number" class="form-control">
                                                        <input name="new_addon[]" type="hidden" value="">
                                                        <span class="input-group-addon">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 del-btn-box">
                                                <button type="button" class="btn btn-danger btn-xs remove-addon"><span
                                                            class="fa fa-minus"></span></button>
                                            </div>
                                        </div>--}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input value="Express Delivery"
                                                           name="gig-addon[2][discription]" type="text"
                                                           class="form-control express"
                                                           placeholder="Enter Addon Discription...">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">Days</span>
                                                        <input type="number" value="" name="gig-addon[2][delivery_day]"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">&euro;</span>
                                                        <input value="50" name="gig-addon[2][price]"
                                                               type="number" class="form-control">
                                                        <input name="new_addon[]" type="hidden"
                                                               value="">
                                                        <span class="input-group-addon">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 del-btn-box">
                                                <button type="button"
                                                        class="btn btn-danger btn-xs remove-addon"><span
                                                            class="fa fa-minus"></span></button>
                                            </div>
                                        </div>
                                    @endif

                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info gig-questions-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Questions</h3>

                                    <div class="btn-group pull-right">
                                        <button type="button" id="add-choice-question"
                                                class="btn btn-primary btn-xs"><span
                                                    class="fa fa-plus"></span> Add Choice Question
                                        </button>
                                        <button disabled type="button" id="add-range-question"
                                                class="btn btn-primary btn-xs"><span
                                                    class="fa fa-plus"></span> Add Range Question
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body">


                                    @if($update)
                                        <?php $i = 1 ?>
                                        @foreach($gigQuestions as $gigQuestion)
                                            <div class="well well-sm">
                                                <div class="pull-right">
                                                    <button type="button"
                                                            class="btn btn-danger btn-xs remove-choice-question"
                                                            data-id="{{ $gigQuestion->id }}"><span
                                                                class="fa fa-minus"></span></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Choice Question</label>
                                                            <input value="{{ $gigQuestion->question }}"
                                                                   name="gig-choice-question[{{ $i }}][question]"
                                                                   type="text"
                                                                   class="form-control" placeholder="Enter ...">
                                                            <input value="{{ $gigQuestion->id }}"
                                                                   name="gig-choice-question[{{ $i }}][question_id]"
                                                                   type="hidden"
                                                                   class="question_id form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Choices</label>


                                                        <?php $answers = explode(',', $gigQuestion->answers) ?>
                                                        <div class="row answers-container">
                                                            @foreach($answers as $answer)
                                                                <div class="col-md-2">
                                                                    <input value="{{ $answer }}" class="answer"
                                                                           name="gig-choice-question[{{ $i }}][answers][]"
                                                                           style="width:100%" type="text">
                                                                </div>
                                                            @endforeach
                                                            {{--<div class="col-md-2">--}}
                                                            {{--<button type="button" style="width:100%;" class="btn btn-primary">Add more choices</button>--}}
                                                            {{--</div>--}}
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach
                                    @endif


                                </div><!-- /.box-body -->
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        @if($update)
                            @if($gig->status == "disabled")
                                <button type="button" class="btn btn-success btn-lg gig-accept-button" data-id="{{ $gig->id }}" data-url="{{ route('gig.accept') }}">Accept</button>
                            @endif
                            @if($gig->rejection == 0)
                                <button type="button" data-toggle="modal" data-target="#rejectModal" class="btn btn-danger btn-lg btn-gig-reject-btn">Reject</button>
                            @else
                                <button type="button" class="btn btn-danger btn-lg rejected-btn">Rejected</button>
                            @endif
                            <input type="hidden" name="upd-fav" value="{{$favor}}">
                            <input class="btn btn-primary btn-lg" type="submit" name="update-accept" value="Update and Accept">
                            <input class="btn btn-primary btn-lg" type="submit" name="save-btn" value="Save now">
                                <a href="{{ route('agenciesSuggestion') }}" class="btn btn-danger btn-lg">Exit</a>
                        @else
                            <button class="btn btn-primary btn-lg" type="submit">Create</button>
                        @endif
                    </div>
                </form>
        </form>
        <div class="modal fade bs-example-modal-sm" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <form action="" method="post" id="gig-rejection">
                        <div class="modal-header"
                             style="background-color:#367fa9;">
                            <button style="color:white;" type="button"
                                    class="close" data-dismiss="modal"
                                    aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                            </button>
                            <h4 style="color:white;" class="modal-title"
                                id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <h4>Reason for Rejection</h4>
                                <textarea class="form-control" id="rejection_reason" cols="38"
                                          rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">Close
                            </button>
                            <input type="hidden" id="reject-gig-id" name="gig-id" value="{{ ($update) ? $gig->id : '' }}">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Select Subcatagories</h4>
                        <span style="display: inline-block;position: absolute;right: 40px;top: 10px;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                            <button type="button" class="btn btn-primary checked-cat" data-dismiss="modal">select / choose</button>
                        </span>
                    </div>
                    <div class="modal-body modal-body-cat">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                        <button type="button" class="btn btn-primary checked-cat" data-dismiss="modal">select / choose</button>
                    </div>
                </div>
            </div>
        </div>
@endsection



@section('pages_css')

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/select2/select2.min.css') }}">

@endsection



@section('pages_script')

    <script src="{{ asset('bower_components/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>

    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <!-- CK Editor -->
    <!-- CK Editor -->
    <script type="text/javascript" src="{{ asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    {{--<script src="{{asset('bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js) }}"></script>--}}
    <script type="text/javascript">
        $(document).ready(function(){
            $(".gig-accept-button").click(function(){
                var url = $(this).data("url");
                var gig_id = $(this).data("id");
                $.ajax({
                   method : "post",
                    url   : url,
                    data  : {'gig-id' : gig_id},
                    dataType : "json",
                    success  : function(res){
                       if(res.status == "enabled") {
                           window.location.href = "{{route('agenciesSuggestion')}}";
                       }else{
                           console.log("error");
                       }
                    }
                });
            });
            $("#gig-rejection").on('submit', function(e){
                var reject_reason = $("textarea#rejection_reason").val();
                var gig_id = $("#reject-gig-id").val();
                var redirect = "{{ route('agenciesSuggestion') }}";
                e.preventDefault();
                $.ajax({
                    method : "post",
                    url   : "{{ route('gigrejection.admin') }}",
                    data  : {gig_id : gig_id, reject_reason : reject_reason},
                    dataType : "json",
                    success : function(res){
                        $('#rejectModal').modal('hide');
                        //notifyMessage('Gig Deleting failed please try again.', 'danger')
                        /*$.notify({
                            // options
                            message: 'Information sent successfully'
                        },{
                            // settings
                            placement: {
                                from: 'bottom',
                                align: 'right'
                            },
                            type: 'info'
                        });*/
                        window.location.href=redirect;
                    }
                });
            });
            $(".rejected-btn").click(function(){
                alert("This favor was already rejected!");
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".form-group input.express").on("keydown keypress keyup", false);
        });
    </script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.

            var wordCountConf1 = {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: false,
                countHTML: false,
                maxWordCount: -1,
                maxCharCount: 800
            }

            var wordCountConf2 = {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: false,
                countHTML: false,
                maxWordCount: -1,
                maxCharCount: 800
            }

            var wordCountConf3 = {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: false,
                countHTML: false,
                maxWordCount: -1,
                maxCharCount: 800
            }


            var source = "{{ asset('bower_components/AdminLTE/plugins/ckeditor/config2.js') }}";
            CKEDITOR.replace('editor1', {wordcount: wordCountConf1,customConfig: source});
            CKEDITOR.replace('editor2', {wordcount: wordCountConf2,customConfig: source});
            CKEDITOR.replace('editor3', {wordcount: wordCountConf3,customConfig: source});
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>


    <script>
        tinymce.init({
            selector: '#gigDiscription'
        });
    </script>

    <script type="text/javascript">

        $('#gig_submit').submit(function(e){

            var dev = $("#subcat_tagsinput");
            var numFiles = $("input:file",this)[0].files.length;
            if( !$.trim( dev.html() ).length ){
                e.preventDefault();
                $('.error').html('Please select at least one sub category');
            }
            if(numFiles > 0){
                $(this).submit();
            }
            else {
                e.preventDefault();
                $('.gig-images-box .box-footer').html('<p style="color:red;">Please select at least one image.</p>');
            }
        });
        $('#gig-submit').submit(function(e){
            var length = $('.gig-images-box-body > div').length;
            var dev = $("#subcat_tagsinput");
            var numFiles = $("input:file",this)[0].files.length;
            if( !$.trim( dev.html() ).length ){
                e.preventDefault();
                $('.error').html('Please select at least one sub category');
            }
        });
        (function () {
            var grab_sel_cat = $('#categorySelectList');
            var grab_sel_val = grab_sel_cat.val();
            var grab_sel_opt = $('#subCategorySelectList').data('select-id');
            if(grab_sel_val != ""){
                $.ajax({
                    url: "{{ route('admin.category.subcategories') }}" + '?cat-id=' + grab_sel_val,
                    method: 'get',
                    success: function (data) {
                        /*$('#subCategorySelectList').attr("data-target","#myModal");
                         $('#subCategorySelectList').attr("data-toggle","modal");*/
                        var cats = '<h4>Select Sub Category</h4>';
                        cats += '<div class="row">';
                        data.forEach(function (element, index, array) {
                            cats +='<div class="col-sm-4">';
                            cats +='<div class="form-group">';
//                            cats +='<label class="btn">';
                               cats += '<input type="checkbox" class="ans" name="sub-cat-check" value="' + element.id + '">';
                            //cats += '<input type="checkbox" class="ans" name="sub-cat-check" value="' + element.id + '"/>';
                            cats +='<span class="cat_name">'+ element.name+'</span>';
//                            cats += '</lable>';
                            cats += '</div>';
                            cats += '</div>';
                        });
                        cats += '</div>';
                        $('.modal-body-cat').html(cats);
                    }
                });
            }
           $('#categorySelectList').change(function (e) {

                var cat = $(this);
                var catId = cat.val();
               console.log(catId);
                $.ajax({
                    url: cat.data('url') + '?cat-id=' + catId,
                    method: 'get',
                    success: function (data) {
                        /*$('#subCategorySelectList').attr("data-target","#myModal");
                        $('#subCategorySelectList').attr("data-toggle","modal");*/
                        var cats = '<h4>Select Sub Category</h4>';
                        data.forEach(function (element, index, array) {
                            cats += '<div class="row">';
                            cats +='<div class="col-sm-4">';
                            cats +='<div class="form-group">';
//                            cats +='<label class="btn">';
                            cats += '<input type="checkbox" class="ans" name="sub-cat-check" value="' + element.id + '"/>';
                            cats +='<span class="cat_name">'+ element.name+'</span>';
//                            cats += '</lable>';
                            cats += '</div>';
                            cats += '</div>';
                            cats += '</div>';
                        });

                        $('.modal-body').html(cats);
                    }
                });

            });

            $(document.body).on('click','.checked-cat',function(){
               var span1 = "";
                var dev = $("#subcat_tagsinput");
                $("#myModal .form-group input[type=checkbox]:checked").each(function() {
                    $('.error').empty();
                        span1 += '<span class="subcat_span"><input type="hidden" value="'+$(this).val()+'" name="gig-sub-category[]" class="single_id"><span>'+$(this).next('.cat_name').html()+'&nbsp;&nbsp;</span>' +
                                '<a href="" title="Removing Sub Category" class="remove-subcat">x</a></span>';
                });
                var trim = $('#subcat_tagsinput').html();
                if($.trim( dev.html()) != '' ){
                    var add = dev.html();
                    dev.html("");
                     dev.append(span1+add);
                }
                else{
                    dev.append(span1);
                }



            });
            $(document.body).on('click','.remove-subcat',function(e){
                e.preventDefault();
                var parent = $(this).parent();
                parent.find('.single_id').val("");
                parent.remove();
            });
            document.querySelector('#fileee').addEventListener('change', function () {
                var files = this.files;
                var imageBox = document.querySelector('.gig-images-box .box-body');
                var imageBoxFooter = $('.gig-images-box .box-footer');
               // $('.gig-images-box .box-body').find('img.new_up').remove();
                if (files.length > 0) {
                    var img_valid_arr = [];
                    imageBoxFooter.html('');
                    for (var i = 0; i < files.length; i++) {

                        var load_img = new Image();
                        load_img.onload = function () {
                            var height = this.height;
                            var width = this.width;
                            if (width == 750 && height == 350) {
                                var imgElement = document.createElement('img');
                                imgElement.className = 'meriimage new_up';
                                imgElement.height = 60;
                                imgElement.src = this.src;
                                imgElement.onload = function () {
                                    window.URL.revokeObjectURL(imgElement.src);
                                };
                                 imageBox.appendChild(imgElement);

                                /*var elem = '<div style="position:relative;display:inline-block;">';
                                elem += ' <button style="position:absolute;right:0px;top:0px;padding:0px 6px;" class="btn btn-default btn-gig-img-remove">x';
                                elem += '</button>';
                                elem += '<img class="meriimage new_up" height="60px" src="'+this.src+'"/>';
                                elem += '</div>';
                                $('.gig-images-box-body').append(elem);*/
                            } else {
                                img_valid_arr.push('not valid');
                            }

                            var sub = files.length - img_valid_arr.length;

                            console.log(sub);

                            var selc_cont = (sub == 0) ? '<p>No image selected.</p>' : '<p>' + sub + ' image selected.</p>';

                            if (img_valid_arr.length > 0) {
                                imageBoxFooter.html(selc_cont + '<p style="color:red;">The image dimensions should be: 750 width and 350 height</p>');

                            } else {
                                imageBoxFooter.html(selc_cont);
                            }
                        };
                        load_img.src = window.URL.createObjectURL(files[i]);

                    }
                } else {
                    imageBoxFooter.html('');
                    imageBoxFooter.html('<p>No image selected.</p>');
                }
            });


            document.querySelector('#add-new-addon').addEventListener('click', addAddon);
            document.querySelector('#add-choice-question').addEventListener('click', addChoiceQuestion);
            document.querySelector('#add-range-question').addEventListener('click', addRangeQuestion);
            $('.btn-gig-img-remove').click(function (e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to delete this image?')) {
                    return false;
                }
                // console.log('Test');
                //alert($(this).attr('href'));
                else {
                    var obj = $(this);
                    $.ajax({

                        method: 'post',
                        url: $(this).data('href'),
                        data: {gigimage_id: $(this).data('image-id')},
                        success: function (data) {
                            console.log(data);

                            if (data.result == true) {

                                obj.parent().remove();
                            }
                            else {
                                console.log(data.result);
                            }
                        }
                    });

                }
            });

            $('.remove-addon').click(function (e) {

                e.preventDefault();
                var addon = $(this);
                $.ajax({

                    method: 'post',
                    url: $(this).data('href'),
                    data: {gigadonid: $(this).data('addonid')},
                    success: function (data) {

                        if (data.result == true) {
                            addon.parent().parent().remove();

                        }
                    }


                });


            });


            $(".select2").select2({
                tags: true,
                tokenSeparators: [','],
                maximumSelectionSize: 0,
            });
            $('.select2-selection__rendered').prepend('<li class="select2-selection__choice" title="hello"><span class="select2-selection__choice__remove" role="presentation">×</span>hello</li>');
            $('.select2-hidden-accessible').prepend('<option value="hello" data-select2-tag="true">hello</option>');


        })();


        function changeName(elem) {

            var name = '';
            var addonContainer = $(elem).parent().parent();

            if (addonContainer.find('.row:last').find('input').length > 0) {
                addonContainer.find('.row:last').find('input[name $= "[discription]"]').each(function () {

                    name = this.name.replace(/\[(\d+)\]/, function (str, p1) {

                        return '[' + (parseInt(p1, 10) + 1) + ']';

                    });

                });
            } else {
                name = "gig-addon[1][discription]";
            }

            return name;

        }

        function changeName2(elem) {

            var name = '';
            var addonContainer = $(elem).parent().parent();

            if (addonContainer.find('.row:last').find('input').length > 0) {
                addonContainer.find('.row:last').find('input[name $= "[price]"]').each(function () {

                    name = this.name.replace(/\[(\d+)\]/, function (str, p1) {

                        return '[' + (parseInt(p1, 10) + 1) + ']';

                    });

                });
            } else {
                name = "gig-addon[1][price]";
            }

            return name;

        }

        function choiceQuestionChangeName(elem) {

            var questionContainer = $(elem).parent().parent().parent();

            if (questionContainer.find('.well:last').find('input').length > 0) {
                questionContainer.find('.well:last').find('input[name $= "[question]"]').each(function () {

                    name = this.name.replace(/\[(\d+)\]/, function (str, p1) {

                        return '[' + (parseInt(p1, 10) + 1) + ']';

                    });

                });
            } else {
                name = "gig-choice-question[1][question]";
            }

            return name;

        }

        function choiceQuestionChangeName2(elem) {

            var questionContainer = $(elem).parent().parent().parent();

            if (questionContainer.find('.well:last').find('select').length > 0) {
                questionContainer.find('.well:last').find('select[name *= "[answers]"]').each(function () {

                    name = this.name.replace(/\[(\d+)\]/, function (str, p1) {

                        return '[' + (parseInt(p1, 10) + 1) + ']';

                    }).replace('[]', '');

                });
            } else {
                name = "gig-choice-question[1][answers]";
            }

            return name;

        }

        function choiceQuestionChangeName3(elem) {

            var questionContainer = $(elem).parent().parent().parent().parent().parent();

            if (questionContainer.find('.well:last').find('.answers-container').length > 0) {
                questionContainer.find('.well:last').find('.answer[name *= "[answers]"]').each(function () {

                    name = this.name.replace(/\[(\d+)\]/, function (str, p1) {

                        return '[' + (parseInt(p1, 10) + 1) + ']';

                    }).replace('[]', '');

                });
            } else {
                name = "gig-choice-question[1][answers]";
            }

            return name;

        }

//        function choiceQuestionChangeName3(elem) {
//
//            var questionContainer = $(elem).parent().parent().parent();
//            if (questionContainer.find('.well:last').find('.answers-container').length > 0) {
//                questionContainer.find('.well:last').find('.answer[name *= "[answers]"]').each(function () {
//
//                    name = this.name.replace(/\[(\d+)\]/, function (str, p1) {
//
//                        return '[' + (parseInt(p1, 10) + 1) + ']';
//
//                    }).replace('[]', '');
//
//                });
//            } else {
//                name = "gig-choice-question[1][answers]";
//            }
//
//            return name;
//
//        }

        function addAddon() {


            console.log(changeName(this));


            var newAddon = $('<div class="row" id="new_addon">' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<input name="' + changeName(this) + '" type="text" class="form-control" placeholder="Enter Addon Discription...">' +
//                    '<input name="' + changeName(this) + '" type="submit" class="btn btn-primary btn-xs pull-right" value="Insert">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<span class="input-group-addon">&euro;</span>' +
                    '<input name="' + changeName2(this) + '" type="number" class="form-control">' +
                    '<input name="new_addon[]" type="hidden" value="">' +
                    '<span class="input-group-addon">.00</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2 del-btn-box">' +
//                    '<button type="button" class="btn btn-primary btn-xs pull-right add-addon">Insert</button>' +
                    '<button type="button" class="btn btn-danger btn-xs remove-addon"><span class="fa fa-minus"></span></button>' +
                    '</div>' +
                    '</div>');


            $('.addons-box .box-body').append(newAddon);

            var removeBtns = document.querySelectorAll('.remove-addon');

            for (var i = 0; i < removeBtns.length; i++) {
                removeBtns[i].addEventListener('click', removeAddon);
            }

//            var addBtn = document.querySelector('.add-addon');
//            addBtn.addEventListener('click', function()
//            {
//
//                var form = this;
//                var addonDisc = $(changeName(this));
//                var addonPrice = $(changeName2(this));
//                var data = {
//                    discription: addonDisc.val(),
//                    price : addonPrice.val()
//                     };
//                alert(addonDisc.val());
////                var formData = new FormData(form);
//                $.ajax({
//
//                    url: form.action,
//                    method: 'post',
//                    data: data,
//                    success: function(data) {
//                        console.log(data);
//
////                        $(form).find('input[type=text]').val(data);
////                        $(form).find('input[type=number]').val("");
////                        var newData = '<input name="' + changeName(this) + '" type="text" class="form-control" placeholder="Enter Addon Discription...">'
//                    }
//
//                });
//            });
//            $(".select2").select2({
//                tags: true,
//                tokenSeparators: [',', ' '],
//                maximumSelectionSize: 0,
//            });


        }

        function removeAddon() {

            this.parentNode.parentNode.remove();

        }
        function addChoiceQuestion() {
            var newChoiceQuestion = $('<div class="well well-sm">' +
                    '<div class="pull-right">' +
                    '<button type="button" class="btn btn-danger btn-xs remove-choice-question"><span class="fa fa-minus"></span></button>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<div class="form-group">' +
                    '<label>Choice Question</label>' +
                    '<input name="' + choiceQuestionChangeName(this) + '" type="text" class="form-control" placeholder="Enter ...">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<label>Choices</label>' +
                    '<div class="row answers-container">' +
                    '<div class="col-md-2">' +
                    '<input class="answer" name="' + choiceQuestionChangeName3(this) + '[]" style="width:100%" type="text">' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '<input class="answer" name="' + choiceQuestionChangeName3(this) + '[]" style="width:100%" type="text">' +
                    '</div>' +
//                    '<div class="col-md-2">' +
//                    '<button type="button" style="width:100%;" class="btn btn-primary">Add more choices</button>' +
//                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');


            $('.gig-questions-box .box-body').append(newChoiceQuestion);

            var removeBtns = document.querySelectorAll('.remove-choice-question');

            for (var i = 0; i < removeBtns.length; i++) {
                removeBtns[i].addEventListener('click', removeChoiceQuestion);
            }


            $(".select2").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                maximumSelectionSize: 0,
            });

        }
//        function addChoiceQuestion() {
//            var newChoiceQuestion = $('<div class="well well-sm">' +
//                    '<div class="pull-right">' +
//                    '<button type="button" class="btn btn-danger btn-xs remove-choice-question"><span class="fa fa-minus"></span></button>' +
//                    '</div>' +
//                    '<div class="row">' +
//                    '<div class="col-md-12">' +
//                    '<div class="form-group">' +
//                    '<label>Choice Question</label>' +
//                    '<input name="' + choiceQuestionChangeName(this) + '" type="text" class="form-control" placeholder="Enter ...">' +
//                    '</div>' +
//                    '</div>' +
//                    '</div>' +
//                    '<div class="row">' +
//                    '<div class="col-md-12">' +
//                    '<label>Choices</label>' +
//                    '<div class="row answers-container">' +
//                    '<form role="form" action="/wohoo" method="POST">'+
//                    '<div class="multi-field-wrapper">'+
//                    '<div class="multi-fields">'+
//                    '<div class="multi-field col-md-3">'+
////                    '<input type="text" class="form-control" name="' + choiceQuestionChangeName3(this) + '[]" style="display: inline; width: 80%;">'+
//                    '<input type="text" class="form-control answer" name="' + choiceQuestionChangeName3(this) + '[]" style="width:100%">' +
//                    '<span class="remove-field btn btn-danger" style="float: right;">-</span>'+
//                    '</div>'+
//                    '</div>'+
//                    '<div class="col-md-2">'+
//                    '<button type="button" class="add-field btn btn-primary">Add more choices</button>'+
//                    '</div>'+
//                    '</div>'+
//                    '</form>'+
//                    '</div>' +
//                    '</div>' +
//                    '</div>' +
//                    '</div>');
//
//
//            $('.gig-questions-box .box-body').append(newChoiceQuestion);
//            addinput();
//            var removeBtns = document.querySelectorAll('.remove-choice-question');
//
//            for (var i = 0; i < removeBtns.length; i++) {
//                removeBtns[i].addEventListener('click', removeChoiceQuestion);
//            }
//
//            $(".select2").select2({
//                tags: true,
//                tokenSeparators: [',', ' '],
//                maximumSelectionSize: 0
//            });
//
//        }

        var removeBtns = document.querySelectorAll('.remove-choice-question');

        for (var i = 0; i < removeBtns.length; i++) {

            removeBtns[i].addEventListener('click', removeChoiceQuestion);
        }

        function removeChoiceQuestion() {

            var question_id = $(this).data("id");
            var retVal = confirm("Are you sure want to delete the question");

            if (retVal == true) {

                $.ajax({
                    type: 'POST',
                    data: {'question_id': question_id},
                    url: '/admin/deleteQuestion',
                    success: function (res) {
                        console.log(res);
                        if (res == true) {
                            alert('Question deleted permanently');
                        } else {
                            alert('nothing to delete');
                        }
                    }
                })

                this.parentNode.parentNode.remove();
            }
            else {
                alert('You havent delete the question');
            }
//            this.parentNode.parentNode.remove();


        }

        function addRangeQuestion() {

            var newRangeQuestion = $('<div class="well well-sm range-question-box">' +
                    '<div class="pull-right">' +
                    '<button type="button" id="remove-range-question" class="btn btn-danger btn-xs remove-range-question"><span class="fa fa-minus"></span></button>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<div class="form-group">' +
                    '<label>Range Question</label>' +
                    '<input type="text" class="form-control" placeholder="Enter ...">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-12">' +
                    '<div class="form-group">' +
                    '<label>Range Options</label><span> <button type="button" id="add-range-option" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></button></span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');

            $('.gig-questions-box .box-body').append(newRangeQuestion);

            document.querySelector('#add-range-option').addEventListener('click', addRangeQuestionOption);


            var removeBtns = document.querySelectorAll('.remove-range-question');

            for (var i = 0; i < removeBtns.length; i++) {
                removeBtns[i].addEventListener('click', removeRangeQuestion);
            }

        }

        function removeRangeQuestion() {

            this.parentNode.parentNode.remove();

        }

        function addRangeQuestionOption() {

            var newRangeQuestionOption = $('<div class="row">' +
                    '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control" placeholder="Option 1">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<img style="width:100%;" src="{{ asset('img/slider_big.png') }}" />' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '<input type="text" class="form-control" placeholder="Option 2">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<button type="button" class="btn btn-danger btn-xs remove-range-option"><span class="fa fa-minus"></span></button>' +
                    '</div>' +
                    '</div>');

            $('.range-question-box').append(newRangeQuestionOption);


            var removeBtns = document.querySelectorAll('.remove-range-option');

            for (var i = 0; i < removeBtns.length; i++) {
                removeBtns[i].addEventListener('click', removeRangeOption);
            }

        }

        function removeRangeOption() {

            this.parentNode.parentNode.remove();

        }

    </script>


    <script>
        /*  window.URL    = window.URL || window.webkitURL;
         var elBrowse  = document.getElementById("fileee"),
         elPreview = document.querySelector(".gig-images-box .box-body"),
         useBlob   = false && window.URL; // `true` to use Blob instead of Data-URL


         // 2.
         function readImage (file) {

         // 2.1
         // Create a new FileReader instance
         // https://developer.mozilla.org/en/docs/Web/API/FileReader
         var reader = new FileReader();

         // 2.3
         // Once a file is successfully readed:
         reader.addEventListener("load", function () {

         // At this point `reader.result` contains already the Base64 Data-URL
         // and we've could immediately show an image using
         // `elPreview.insertAdjacentHTML("beforeend", "<img src='"+ reader.result +"'>");`
         // But we want to get that image's width and height px values!
         // Since the File Object does not hold the size of an image
         // we need to create a new image and assign it's src, so when
         // the image is loaded we can calculate it's width and height:
         var image  = new Image();
         image.addEventListener("load", function () {
         maxWidth = 750;
         maxHeight = 350;
         var ratio = maxWidth/maxHeight;
         if(image.width/image.height < ratio){
         alert('Image width should be 750px and height 350px');
         } else{
         var imageBox = document.querySelector('.gig-images-box .box-body');
         var imageBoxFooter = document.querySelector('.gig-images-box .box-footer');
         // Finally append our created image and the HTML info string to our `#preview`
         elPreview.appendChild( this );
         //elPreview.insertAdjacentHTML("beforeend", imageInfo +'<br>');
         imageBox.appendChild(this);

         imageBoxFooter.innerHTML = '';
         imageBoxFooter.innerHTML = '<p>'+ this.length +' image selected.</p>';
         }
         // Concatenate our HTML image info
         /!*var imageInfo = file.name    +' '+ // get the value of `name` from the `file` Obj
         image.width  +'×'+ // But get the width from our `image`
         image.height +' '+
         file.type    +' '+
         Math.round(file.size/1024) +'KB';*!/


         });

         image.src = useBlob ? window.URL.createObjectURL(file) : reader.result;

         // If we set the variable `useBlob` to true:
         // (Data-URLs can end up being really large
         // `src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAA...........etc`
         // Blobs are usually faster and the image src will hold a shorter blob name
         // src="blob:http%3A//example.com/2a303acf-c34c-4d0a-85d4-2136eef7d723"
         if (useBlob) {
         // Free some memory for optimal performance
         window.URL.revokeObjectURL(file);
         }
         });

         // 2.2
         // https://developer.mozilla.org/en-US/docs/Web/API/FileReader/readAsDataURL
         reader.readAsDataURL(file);

         }

         // 1.
         // Once the user selects all the files to upload
         // that will trigger a `change` event on the `#browse` input
         elBrowse.addEventListener("change", function() {

         // Let's store the FileList Array into a variable:
         // https://developer.mozilla.org/en-US/docs/Web/API/FileList
         var files  = this.files;
         // Let's create an empty `errors` String to collect eventual errors into:
         var errors = "";

         if (!files) {
         errors += "File upload not supported by your browser.";
         }

         // Check for `files` (FileList) support and if contains at least one file:
         if (files && files[0]) {

         // Iterate over every File object in the FileList array
         for(var i=0; i<files.length; i++) {

         // Let's refer to the current File as a `file` variable
         // https://developer.mozilla.org/en-US/docs/Web/API/File
         var file = files[i];

         // Test the `file.name` for a valid image extension:
         // (pipe `|` delimit more image extensions)
         // The regex can also be expressed like: /\.(png|jpe?g|gif)$/i
         if ( (/\.(png|jpeg|jpg|gif)$/i).test(file.name) ) {
         // SUCCESS! It's an image!
         // Send our image `file` to our `readImage` function!
         readImage( file );
         } else {
         errors += file.name +" Unsupported Image extension\n";
         }
         }
         }

         // Notify the user for any errors (i.e: try uploading a .txt file)
         if (errors) {
         alert(errors);
         }

         });*/
    </script>
    <script type="text/javascript">
        function addinput() {
            $('.multi-field-wrapper').each(function () {
                var $wrapper = $('.multi-fields', this);
                $(".add-field", $(this)).click(function (e) {
                    $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
                });
                $('.multi-field .remove-field', $wrapper).click(function () {
                    if ($('.multi-field', $wrapper).length > 1)
                        $(this).parent('.multi-field').remove();
                });
            });
        }
    </script>
@endsection
