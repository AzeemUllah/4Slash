@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Create a new Package</h1>

@endsection




@section('content')

    <form method="post"
          action="{{ (($update) ? route('admin.package.update') : route('Create.Agencypacakge') ) }}"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <!-- text input -->
                            <div class="col-md-6 form-group">
                                <label>Title</label>
                                <input name="package-title" type="text"
                                       value="{{ $update ? $packages->title: '' }}"
                                       class="form-control"
                                       placeholder="Enter Package Title...">
                                <input type="hidden"
                                       value="{{ $update ? $packages->packages_id: ''}}"
                                       name="package_id">
                            </div>
                            <div class="form-group">
                                <label>Description (what you need to start the Order) <span style="color:#b299a5; font-weight: 500;"><br>Please explain in a few words what the client need to send you (Maximum 800 characters)</span>
                                    <span style="padding: 2px 8px; background: #dadbda;border-radius: 15px;">
                                    <i style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button"
                                       data-toggle="popover" data-trigger="focus" data-placement="left"
                                       data-content="copy and paste funtion will work only in the (source code)HTML mode"></i>
                                </span>
                                </label>
                                <textarea id="editor1" name="package-discription"
                                          rows="10" cols="80"
                                          placeholder="Enter favor Discription...">
                                        {{ ($update) ? $packages->pack_desc : Request::old('package-discription') }}
                        </textarea>
                                @if($errors->has('package-discription'))
                                    <span class="help-block"
                                          style="color:#ff0000">Please complete the package description</span>
                                    <span class="help-block"
                                          style="color:#ff0000">Please complete the Package Description</span>
                                @endif
                                <span class="error-desc1-1"></span>
                                <span class="error-desc1-2"></span>
                            </div>
                        <!--Assocition-->
                        <div class="box box-info">
                            <div class="row">
                                <div class="col-md-12 form-group"><label
                                            for="">Package Association</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="radio" name="association"
                                           id="radio1" {{ ($packages->favor_id == 0) ? 'checked' : '' }}>
                                    <label for="radio1">No Favor</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="radio" name="association"
                                           id="radio2" {{ ($packages->favor_id > 0) ? 'checked' : '' }}>
                                    <label for="radio2">Sync with my
                                        favor</label>
                                </div>
                                <div class="col-md-4 form-group"></div>
                            </div>
                            <!--Association by Category  & subcategory-->
                            <div id="cat-association" style="{{ (!empty($packages->packages_types_id) && $packages->favor_id == 0) ? '' : 'display:none' }};">
                                <div class="row" style="margin:0px;">
                                    <div class="form-group cat" style="position: relative;">
                                        <label for="categorySelectList">Category </label>
                                        <select id="categorySelectList" name="package-category"
                                                class="form-control"
                                                data-url="{{ route('admin.category.subcategories') }}" style="{{ ($update)? '' :'padding-left: 32px;-webkit-appearance: none;' }};">
                                            <option value="">You must select a Category</option>
                                            @foreach($categories as $category)
                                                <option {{ (($update) ? (($category->id == $packages->packages_types_id) ? 'selected' : '') : (Request::old('gig-category') == $category->id) ? 'selected' : '')   }}  value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                        @if(!($update))
                                            <i id="warning1" class="fa fa-exclamation" aria-hidden="true" style="color:red; border: 1px solid red; padding: 3px 8px; border-radius: 15px; position: absolute; top:32px; left:5px;"></i>
                                        @endif
                                        @if($errors->has('gig-category'))
                                            {{--<span class="help-block"--}}
                                            {{--style="color:#ff0000">{{ $errors->first('gig-category') }}</span>--}}
                                            <span class="help-block"
                                                  style="color:#ff0000">Please select the favor category</span>
                                            <span class="help-block"
                                                  style="color:#ff0000">Please select the Category</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Subcategory -->
                                <div class="row" style="margin:0px;">
                                    <div class="form-group" style="position: relative;">
                                                    <span style="margin-bottom: 20px;">
                                                        <label style="float: left;">Sub Category</label>
                                                        <label style="float: left; margin-left: 10px; margin-bottom: 5px;" class="btn btn-primary btn-xs" for="subcat"  data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span></label>
                                                    </span>
                                        <p class="error" style="float:left; width: 100%;"></p>
                                        <div id="subcat_tagsinput" class="subcatinput" style="width: 100%; margin-top: 20px;">
                                            @if($update)
                                                @foreach($subcategory as $subcat)
                                                    <span class="subcat_span">
                                                    <input type="hidden" value="{{$subcat->id}}" name="gig-sub-category[]" class="single_id">
                                                    <span>{{$subcat->name}}&nbsp;&nbsp;</span>
                                                    <a href="" title="Removing Sub Category" class="remove-subcat">x</a>
                                                </span>
                                                @endforeach
                                            @endif
                                            @if(empty($subcat))
                                                <i id="warning2" class="fa fa-exclamation" aria-hidden="true" style="color:red; border: 1px solid red; padding: 3px 8px; border-radius: 15px; position: absolute; top:50px; left:5px;"></i>
                                                <p id="warning-para2" style="color:#9999a2; {{ ($update)? '' :'padding-left: 32px; padding-top:7px' }};">You must select atleast one Sub Category</p>
                                            @endif
                                        </div>
                                        {{--<input type="text" id="subCategorySelectList" class="form-control" data-toggle="modal" data-target="#myModal">--}}
                                    </div>
                                </div>
                            </div>
                            <!--Assocation by favor-->
                            <div class="row" style="margin:0px; {{ (!empty($packages->favor_id)) ? '' : 'display:none' }};" id="favor-assocation">
                                <div class="form-group col-md-6" style="padding:0px;">
                                    <label for="favors_associate">Favors List</label>
                                    <select name="favor_associate" id="favors_associate" class="form-control">
                                        @foreach($agency_favors as $favors)
                                            <option {{ (($update) ? (($favors->id == $packages->favor_id) ? 'selected' : '') : (Request::old('favor_associate') == $favors->id) ? 'selected' : '')   }} value="{{ $favors->id }}">{{ $favors->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="box box-info gig-images-box">
                            <div class="box-header with-border">
                                <h3 class="box-title image-title"><span><img src="/img/img_thumnail.png" alt="" style="width: 50px; margin-right:10px;"></span>Images / Bilder <span class="red">(750x350)</span>
                                    @if(\Illuminate\Support\Facades\Session::has('gig-image'))
                                        <span class="help-block"
                                              style="color:#ff0000; font-size:12px; display:inline-block"> ({{ \Illuminate\Support\Facades\Session::get('gig-image') }}
                                            )</span>
                                        {{ \Illuminate\Support\Facades\Session::forget('gig-image') }}
                                    @endif
                                </h3>
                                <input style="position:absolute;top:0px;left:0px;width:0.1px;height:0.1px;opacity:0;overflow:hidden;"
                                       name="gig-images[]" accept="image/*" type="file" multiple
                                       id="fileee">
                                <label style="margin-left: 10px;" class="btn btn-primary btn-xs" for="fileee"><span
                                            class="fa fa-plus"></span></label>
                            </div>

                            <div class="box-body gig-images-box-body">
                                @if($update)
                                    @if(!empty($packageimages) && count($packageimages) > 0)
                                        @foreach($packageimages as $packageimage)
                                            @if(!empty($packageimage))
                                                <div style="position:relative;display:inline-block;">


                                                    <button data-href="{{ route('packages.images.remove.agency') }}"
                                                            data-image-id="{{  $packageimage->id }}"
                                                            style="position:absolute;right:0px;top:0px;padding:0px 6px;"
                                                            class="btn btn-default btn-gig-img-remove">x
                                                    </button>
                                                    <img style="height:60px;"
                                                         src="{{ url('/files/gigs/images') . '/' . $packageimage->image }}"
                                                         class="meriimage">
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            <div class="box-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="package_table">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">
                            <span style="display:block;"><img src="{{ url('/') .'/img/bronze_label.png' }}" alt="" width="50px"></span>
                            <span style="font-size: 25px;">Bronze</span>
                        </th>
                        <th class="text-center">
                            <span style="display:block;"><img src="{{ url('/') .'/img/silver_label.png' }}" alt="" width="50px"></span>
                            <span style="font-size: 25px;">silver</span>
                        </th>
                        <th class="text-center">
                            <span style="display:block;"><img src="{{ url('/') .'/img/gold_label.png' }}" alt="" width="50px"></span>
                            <span style="font-size: 25px;">Gold</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Package name</td>
                        <td>
                            <input type="text" value="{{ ($update) ? $package_bronze->package_name : '' }}" class="form-control" name="platinum_package_name" placeholder="Package Name">
                        </td>
                        <td>
                            <input type="text" value="{{ ($update) ? $package_silver->package_name : '' }}" class="form-control" name="silver_package_name" placeholder="Package Name">
                        </td>
                        <td>
                            <input type="text" value="{{ ($update) ? $package_gold->package_name : '' }}" class="form-control" name="gold_package_name" placeholder="Package Name">
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="platinum_package_text" id="editor2" cols="30"
                                      rows="4" class="form-control">{{ ($update) ? $package_bronze->desc : '' }}</textarea>
                        </td>
                        <td><textarea name="silver_package_text" id="editor3" cols="30"
                                      rows="4" class="form-control">{{ ($update) ?  $package_silver->desc :'' }}</textarea>
                        </td>
                        <td><textarea name="gold_package_text" id="editor4" cols="30"
                                      rows="4" class="form-control">{{ ($update) ? $package_gold->desc : '' }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Days of Delivery</td>
                        <td>
                            <input type="number" value="{{ ($update) ? $package_bronze->delivery_days :'' }}" class="form-control" name="platinum_days">
                        </td>
                        <td>
                            <input type="number" value="{{ ($update) ? $package_silver->delivery_days : '' }}" class="form-control" name="silver_days">
                        </td>
                        <td>
                            <input type="number" value="{{ ($update) ? $package_gold->delivery_days : '' }}" class="form-control" name="gold_days">
                        </td>
                    </tr>
                    <tr>
                        <td>Source File</td>
                        <td class="text-center">
                            <input type="checkbox" {{ ($update) ? ($package_bronze->source_file>0)? 'checked' : '' : '' }} name="platinum_source" value="1">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" {{ ($update) ? ($package_silver->source_file>0)? 'checked' : '' : '' }} name="silver_source" value="1">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" {{ ($update) ? ($package_gold->source_file>0)? 'checked' : '' : '' }} name="gold_source" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td style="width:200px;">
                            <span>Options</span>
                            <button id="btnAddMoreOption" type="button"
                                    class="btn btn-primary btn-xs">
                                <span class="fa fa-plus"></span>
                            </button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if($update)
                    @foreach($package_option as $option)
                    <tr class="count_tr">
                        <td class="text-center">
                            <input name="package-option[]" type="text" class="form-control" placeholder="Enter Option..." value="{{ $option->option }}">
                        </td>
                        <td class="text-center">
                            <input name="package_option_namebronze[]" {{ $option->bronze >0 ? 'checked' : '' }} type="checkbox" value="1">
                        </td>
                        <td class="text-center">
                            <input name="package_option_namesilver[]" {{ $option->silver >0 ? 'checked' : '' }} type="checkbox" value="1">
                        </td>
                        <td class="text-center">
                            <input name="package_option_namegold[]" {{ $option->gold >0 ? 'checked' : '' }} type="checkbox" value="1">
                        </td>
                        <td>
                            <button type="button" class="form-control btn btn-danger remove_optione" onclick="remove_option()">
                                <span class="fa fa-minus"></span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td>Revisions</td>
                        <td>
                            <input type="number" value="{{ ($update) ? $package_bronze->revisions : '' }}" name="platinum_revision" class="form-control" placeholder="No of days">
                        </td>
                        <td>
                            <input type="number" value="{{ ($update) ? $package_silver->revisions : '' }}" name="silver_revision" class="form-control" placeholder="No of days">
                        </td>
                        <td>
                            <input type="number" value="{{ ($update) ? $package_gold->revisions : '' }}" name="gold_revision" class="form-control" placeholder="No of days">
                        </td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            {{--                            <input type="number" value="{{ ($update) ? $package_bronze->price : Request::old('platinum_package_price') }}" name="platinum_package_price" class="form-control" placeholder="€">--}}
                            <select name="platinum_package_price" id="" class="form-control">
                                @for($i = 10; $i<=100 ; $i+=10)
                                    <option {{ (($update) ? (($package_bronze->price == $i) ? 'selected' : '') : (Request::old('platinum_package_price') == $i) ? 'selected' : '') }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('platinum_package_price'))
                                <span class="help-block"
                                      style="color:#ff0000">Please set the Price for Package</span>
                            @endif
                        </td>
                        <td>
                            <select name="silver_package_price" id="" class="form-control">
                                @for($i = 110; $i<=200 ; $i+=10)
                                    <option {{ (($update) ? (($package_silver->price == $i) ? 'selected' : '') : (Request::old('silver_package_price') == $i) ? 'selected' : '') }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('silver_package_price'))
                                <span class="help-block"
                                      style="color:#ff0000">Please set the Price for Package</span>
                            @endif
                        </td>
                        <td>
                            {{--                            <input type="number" value="{{ ($update ? $package_gold->price : Request::old('gold_package_price')) }}" name="gold_package_price" class="form-control" placeholder="€">--}}
                            <select name="gold_package_price" id="" class="form-control">
                                @for($i = 210; $i<=300 ; $i+=10)
                                    <option {{ (($update) ? (($package_gold->price == $i) ? 'selected' : '') : (Request::old('gold_package_price') == $i) ? 'selected' : '') }} value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            @if($errors->has('gold_package_price'))
                                <span class="help-block"
                                      style="color:#ff0000">Please set the Price for Package</span>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" name="agency_id" value="{{ $packages->user_id }}">
        <div class="text-center">
            @if(isset($update) && $update)
                <input type="hidden" name="action" value="update">
                <input name="update-package" class="btn btn-primary btn-lg"
                        type="submit" value="Update and Accept">
                {{--<button class="btn btn-primary btn-lg"
                        type="button">View Package
                </button>--}}
            @else
                <input name="create_package" class="btn btn-primary btn-lg"
                       type="submit" value="Create Package">
            @endif
            <input name="save_package" class="btn btn-primary btn-lg"
                   type="submit" value="Save Only">
        </div>
    </form>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Select Subcatagories</h4>
                    <span style="display: inline-block; position: absolute; right: 40px; top: 10px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                        <button type="button" class="btn btn-primary checked-cat" data-dismiss="modal">select / choose</button>
                    </span>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary checked-cat" data-dismiss="modal">select / choose</button>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('pages_css')


@endsection



@section('pages_script')
    <!-- CK Editor -->
    <script type="text/javascript" src="{{ asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
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
            CKEDITOR.replace('editor4', {wordcount: wordCountConf3,customConfig: source});
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
    <script>
        (function () {
            var rows= 0;
            @if($update)
            var count = $('#package_table tbody tr.count_tr').length;
            @else
            var count = 0;
            @endif
            $('#btnAddMoreOption').click(function (e) {
                var option = '<tr>' +
                    '<td>' +
                    '<input name="package-option[]" type="text" class="form-control" placeholder="Enter Option...">' +
                    '</td>' +
                    '<td class="text-center">'+
                    '<input name="package_option_namebronze['+count+']" type="checkbox" value="1">' +
                    '</td>'+
                    '<td class="text-center">'+
                    '<input name="package_option_namesilver['+count+']" type="checkbox" value="1">' +
                    '</td>'+
                    '<td class="text-center">'+
                    '<input name="package_option_namegold['+count+']" type="checkbox" value="1">' +
                    '</td>'+
                    '<td>'+
                    '<button type="button" class="form-control btn btn-danger remove_optione" onclick="remove_option()">'+
                    '<span class="fa fa-minus"></span>'+
                    '</button>'+
                    '</td>'+
                    '</tr>';
                $(option).insertAfter($(this).parent().parent());
                count++;
            });
        })();
        function remove_option(){
            $(".remove_optione").click(function(){
                var parent = $(this).parent().parent();
                parent.hide();
            });
        };
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#categorySelectList").on('change',function(){
                $("#warning1").hide();
            });
            $("#radio1").click(function(){
                $("#cat-association").show();
                $("#favor-assocation").hide();
            });
            $("#radio2").click(function(){
                $("#cat-association").hide();
                $("#favor-assocation").show();
            });
        });
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
                    data: {packageimage_id: $(this).data('image-id')},
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
    </script>
    {{--<script>
        (function() {
            $('#btnAddMoreOption').click(function(e) {
                var option = '<div class="col-md-2 form-group"><input name="package-option[]" type="text" class="form-control" placeholder="Enter Option..."></div>';
                $(option).insertBefore($(this).parent());
            });
            $('.remove-option').click(function (e) {

                e.preventDefault();
                var option = $(this);
                $.ajax({

                    method: 'post',
                    url: $(this).data('href'),
                    data: {gigoptionid: $(this).data('optionid')},
                    success: function (data) {

                        if (data.result == true) {
                            option.parent().remove();

                        }
                    }


                });


            });
        })();
    </script>--}}
    <script type="text/javascript">
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
                $("#warning2").hide();
                $("#warning-para2").hide();
            }
            else{
                dev.append(span1);
                $("#warning2").hide();
                $("#warning-para2").hide();
            }
        });
        $(document.body).on('click','.remove-subcat',function(e){
            e.preventDefault();
            var parent = $(this).parent();
            var text = parent.find('.single_id').val("");
            $(this).parent().remove();
        });
        document.querySelector('#fileee').addEventListener('change', function () {
            var files = this.files;
            var imageBox = document.querySelector('.gig-images-box .box-body');
            var imageBoxFooter = $('.gig-images-box .box-footer');
            $('.gig-images-box .box-body').find('img.new_up').remove();
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
                        } else {
                            img_valid_arr.push('not valid');
                        }

                        var sub = files.length - img_valid_arr.length;

                        console.log(sub);

                        var selc_cont = (sub == 0) ? '<p>No image selected.</p>' : '<p>' + sub + ' image selected.</p>';

                        if (img_valid_arr.length > 0) {
                            imageBoxFooter.html(selc_cont + '<p style="color:red;">The image dimensions should be: 750 width and 350 height</p>');
                            $("#fileee").val("");
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
    </script>


@endsection