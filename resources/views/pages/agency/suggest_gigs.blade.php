@extends('pages.agency.agency_template')

@section('header_title')
    <style>
        .green{
            color:green;
        }
        .red{
            color:red;
        }
    </style>
    <h1 style="padding: 0px 10px;">Dashboard
    </h1>

@endsection

@section('content')
    <div class="row">
        @include('pages.agency.partials.side_menue')
        <div class="box-body no-padding">

            <div class="box-body">
                <div class="col-md-9">
                    <div class="box box-info" id="suggestion_content">
                        <div class="box-header with-border">
                            @if(!empty($type) && $type == 'gig')
                                <h3 class="box-title">Suggest a Favor / Ihr Favor Vorschlag</h3>
                            @elseif(!empty($type) && $type == 'package')
                                <h3 class="box-title">Suggest a Package / Ihr Paket Vorschlag</h3>
                            @endif
                        </div><!-- /.box-header -->
                        @if(!empty($type) && $type == 'gig')
                            @if($update)
                                <form action="{{ route('suggestgig.update') }}" method="post"
                                      enctype="multipart/form-data" id="gig-submit" >
                                    <input type="hidden" name="gig-id" value="{{ $gig->id }}">
                                    @else
                                        <form action="{{ route('Create.Agencygig') }}" method="post"
                                              enctype="multipart/form-data" id="gig_submit">
                                            @endif
                                            <div class="box-body">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Title / Titel</label>
                                                    <input value="{{ ($update) ? $gig->title : Request::old('gig-title') }}"
                                                           name="gig-title" type="text" maxlength="50"
                                                           class="form-control favor-title" placeholder="Enter favor Title...">
                                                    <span>(Maximum 50 characters)</span>
                                                    @if($errors->has('gig-title'))
                                                        {{--<span class="help-block"--}}
                                                        {{--style="color:#ff0000">{{ $errors->first('gig-title') }}</span>--}}
                                                        <span class="help-block"
                                                              style="color:#ff0000;">Bitte wählen Sie eine favor-title aus</span>
                                                        <span class="help-block"
                                                              style="color:#ff0000">Please choose a favor-title from</span>
                                                    @endif
                                                    <span class="error-block1"></span>
                                                    <span class="error-block2"></span>
                                                </div>


                                                {{--<div class="form-group">
                                                    <label>Short Discription /
                                                        Kurzbeschreibung</label>
                                                    <input value="{{ ($update) ? $gig->short_discription : Request::old('gig-short-discription') }}"
                                                           name="gig-short-discription"
                                                           type="text" class="form-control"
                                                           placeholder="Enter favor Short Discription...">
                                                    @if($errors->has('gig-short-discription'))
                                                        --}}{{--<span class="help-block"--}}{{--
                                                        --}}{{--style="color:#ff0000">{{ $errors->first('gig-short-discription') }}</span>--}}{{--
                                                        <span class="help-block"
                                                              style="color:#ff0000">Bitte ergänzen Sie die Favor Kurzbeschreibung</span>
                                                        <span class="help-block"
                                                              style="color:#ff0000">Please write a favor-short discription</span>
                                                    @endif
                                                </div>--}}


                                                <!-- textarea -->
                                                <div class="form-group">
                                                    <label>Description (Was Kunde bekommt / What Customer get) <span style="color:#b299a5; font-weight: 500;">Please explain in a few words what the client buys. (Maximum 800 characters)</span>
                                                        <span style="padding: 2px 10px; background: #dadbda;border-radius: 15px; display: inline-block;">
                                    <i style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button"
                                       data-toggle="popover" data-trigger="focus" data-placement="left"
                                       data-content="copy and paste funtion will work only in the (source code)HTML mode"></i>
                                </span>
                                                    </label>
                                                    {{--<textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                                              placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>--}}

                                                    <textarea id="editor1" name="gig-discription"  rows="10" cols="80"
                                                              placeholder="Enter favor Discription...">
                                            {{ ($update) ? $gig->discription : Request::old('gig-discription') }}
                            </textarea>
                                                    {{--<textarea style="display:none;" name="gig-discription" id="desc" cols="30" rows="10"></textarea>--}}
                                                @if($errors->has('gig-discription'))
                                                        {{--<span class="help-block"--}}
                                                        {{--style="color:#ff0000">{{ $errors->first('gig-discription') }}</span>--}}
                                                        <span class="help-block"
                                                              style="color:#ff0000">Bitte ergänzen Sie die Favor Beschreibung</span>
                                                        <span class="help-block"
                                                              style="color:#ff0000">Please complete the Favor Description</span>
                                                    @endif
                                                    <span class="error-desc1-1"></span>
                                                    <span class="error-desc1-2"></span>
                                                </div>
                                                <!-- textarea2 -->
                                                <div class="form-group">
                                                    <label>Description (Was Sie benötigen, um den Auftrag zu beginnen / what you need to start the Order) <span style="color:#b299a5; font-weight: 500;"><br>Please explain in a few words what the client need to send you (Maximum 800 characters)</span>
                                                        <span style="padding: 2px 8px; background: #dadbda;border-radius: 15px;">
                                    <i style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button"
                                       data-toggle="popover" data-trigger="focus" data-placement="left"
                                       data-content="copy and paste funtion will work only in the (source code)HTML mode"></i>
                                </span>
                                                    </label>
                                                    {{--<textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                                              placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>--}}

                                                    <textarea id="editor2" name="gig-discription1" rows="10" cols="80"
                                                              placeholder="Enter favor Discription...">
                                            {{ ($update) ? $gig->discription2 : Request::old('gig-discription1') }}

                            </textarea>
                                                    {{--<textarea style="display:none;" name="gig-discription1" id="desc1" cols="30" rows="10"></textarea>--}}
                                                    @if($errors->has('gig-discription1'))
                                                        {{--<span class="help-block"--}}
                                                        {{--style="color:#ff0000">{{ $errors->first('gig-discription') }}</span>--}}
                                                        <span class="help-block"
                                                              style="color:#ff0000">Bitte ergänzen Sie die Favor Beschreibung</span>
                                                        <span class="help-block"
                                                              style="color:#ff0000">Please complete the Favor Description</span>
                                                    @endif
                                                    <span class="error-desc2-1"></span>
                                                    <span class="error-desc2-2"></span>
                                                </div>
                                                <!-- textarea2 -->
                                                {{--<div class="form-group">
                                                    <label>Description (Erweiterungen (Aufpreis) / Extensions & Extras) <span style="color:#b299a5; font-weight: 500;">Please explain in a few words what extras you are offering (Maximum 800 characters)</span></label>
                                                    --}}{{--<textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                                              placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>--}}{{--

                                                    <textarea id="editor3" name="gig-discription2" rows="10" cols="80"
                                                              placeholder="Enter favor Discription...">
                                            {{ ($update) ? $gig->discription3 : Request::old('gig-discription2') }}

                            </textarea>
                                                    --}}{{--<textarea style="display:none;" name="gig-discription2" id="desc2" cols="30" rows="10"></textarea>--}}{{--
                                                    @if($errors->has('gig-discription2'))
                                                        --}}{{--<span class="help-block"--}}{{--
                                                        --}}{{--style="color:#ff0000">{{ $errors->first('gig-discription') }}</span>--}}{{--
                                                        <span class="help-block"
                                                              style="color:#ff0000">Bitte ergänzen Sie die Favor Beschreibung</span>
                                                        <span class="help-block"
                                                              style="color:#ff0000">Please complete the Favor Description</span>
                                                    @endif
                                                    <span class="error-desc3-1"></span>
                                                    <span class="error-desc3-2"></span>
                                                </div>--}}
                                                <div class="form-group">
                                                    <label for="">Embed Video / Video einfugen</label>
                                                    <textarea class="form-control" name="videos" id="embed_video" cols="30" rows="5"
                                                              placeholder="Place your video embed code here..">{{ ($update) ? $gig->gig_videos : Request::old('videos') }}</textarea>
                                                </div>
                                                <!-- select -->
                                                <div class="form-group cat" style="position: relative;">
                                                    <label>Category / Kategorie</label>
                                                    <select id="categorySelectList" name="gig-category"
                                                            class="form-control"
                                                            data-url="{{ route('agency.category.subcategories') }}" required style="{{ ($update)? '' :'padding-left: 32px;-webkit-appearance: none;' }};">
                                                        <option value="">You must select a Category</option>
                                                        @foreach($categories as $category)
                                                            <option {{ (($update) ? (($category->id == $gig->gigtype_id) ? 'selected' : '') : (Request::old('gig-category') == $category->id) ? 'selected' : '')   }}  value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach

                                                    </select>
                                                    @if(!($update))
                                                    <i id="warning1" class="fa fa-exclamation" aria-hidden="true" style="color:red; border: 1px solid red; padding: 3px 8px; border-radius: 15px; position: absolute; top:32px; left:5px;"></i>
                                                    @endif
                                                    @if($errors->has('gig-category'))
                                                        {{--<span class="help-block"--}}
                                                        {{--style="color:#ff0000">{{ $errors->first('gig-category') }}</span>--}}
                                                        <span class="help-block"
                                                              style="color:#ff0000">Bitte wählen Sie die Favor Kategorie aus</span>
                                                        <span class="help-block"
                                                              style="color:#ff0000">Please select the Category</span>
                                                    @endif
                                                </div>


                                                <div class="form-group" style="position: relative;">
                                                    <span style="margin-bottom: 20px;">
                                                        <label for="subcat"  data-toggle="modal" data-target="#myModal" style="float: left; cursor: pointer;">Sub Category / Subkategorie
                                                            @if($errors)
                                                                <span class="help-block"
                                                                      style="color:#ff0000; font-size:12px; display:inline-block"> (At least one Sub Category is required)</span>
                                                            @endif
                                                        </label>
                                                        <label style="float: left; margin-left: 10px; margin-bottom: 5px;" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span></label>
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
                                                                <i id="warning2" class="fa fa-exclamation" aria-hidden="true" style="color:red; border: 1px solid red; padding: 3px 8px; border-radius: 15px; position: absolute; top:60px; left:5px;"></i>
                                                                <p id="warning-para2" style="color:#9999a2; {{ ($update)? '' :'padding-left: 32px; padding-top:7px' }};">You must select atleast one Sub Category</p>
                                                            @endif
                                                    </div>
                                                    {{--<input type="text" id="subCategorySelectList" class="form-control" data-toggle="modal" data-target="#myModal">--}}
                                                </div>


                                                <!-- select -->
                                                <div class="row">

                                                    <div class="col-md-6 form-group">
                                                        <label>Delivery Days / Lieferzeit</label>
                                                        <select name="gig-delivery-days" class="form-control">
                                                            @for($i = 1; $i <= 30; $i++)
                                                                <option {{ (($update) ? (($gig->delivery_days == $i) ? 'selected' : '') : '') }} value="{{ $i }}" {{ ($i == 10) ? 'selected':'' }}>{{ $i }}</option>
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
                                            <div class="box box-info gig-images-box">
                                                <div class="box-header with-border">
                                                    <label style="margin-left: 10px; cursor: pointer;" for="fileee">
                                                    <h3 class="box-title image-title"><span><img src="/img/img_thumnail.png" alt="" style="width: 50px; margin-right:10px;"></span> Images / Bilder <span class="red">(750x350)</span>
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
                                                    <span class="fa fa-plus btn btn-primary btn-xs"></span>
                                                    </label>
                                                </div>

                                                <div class="box-body gig-images-box-body">
                                                    {{--@if($update)--}}
                                                    <ul id="sortable" style="list-style-type: none;">
                                                        @if(!empty($gigImages) && count($gigImages) > 0)
                                                            @foreach($gigImages as $gigImage)
                                                                @if(!empty($gigImage))
                                                                    <li class="ui-state-default" style="float:left; position: relative;cursor:move; margin-right: 5px;">
                                                                            <button data-href="{{ route('gig.images.remove.agency') }}"
                                                                                    data-image-id="{{  $gigImage->id }}"
                                                                                    style="position:absolute;right:0px;top:0px;padding:0px 6px;"
                                                                                    class="btn btn-default btn-gig-img-remove">x
                                                                            </button>
                                                                            <img style="height:60px;"
                                                                                 src="{{ url('/files/gigs/images') . '/' . $gigImage->image }}"
                                                                            class="meriimage" for="fileee">
                                                                        <input style="position:absolute;top:0px;left:0px;width:0.1px;height:0.1px;opacity:0;overflow:hidden;"
                                                                               name="gig-images[]" accept="image/*" type="file" multiple
                                                                               id="fileee">
                                                                        <input type="hidden" name="gig_image_id[]" value="{{ $gigImage->id }}">
                                                                        <input type="hidden" name="gig_image_name[]" value="{{ $gigImage->image }}">
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="box-footer"></div>
                                            </div>
                                            {{--<div class="box box-info addons-box">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Embed videos</h3>
                                                </div>
                                                <div class="box-body">
                                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>--}}
                                            <div class="box box-info addons-box">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Addons / Erweiterungen</h3>
                                                    <button type="button" id="add-new-addon"
                                                            class="btn btn-primary btn-xs" style="margin-left:10px;"><span
                                                                class="fa fa-plus"></span></button>
                                                </div>
                                                <div class="box-body">
                                                    @if($update)
                                                        <?php $i = 1; ?>
                                                        @foreach($gigAddons as $gigAddon)
                                                            <div class="row" style="margin-left: -10px; margin-right: -10px;">
                                                                @if($gigAddon->addon == "Expresslieferung")
                                                                    <div class="col-xs-12" style="border-top:1px solid #ececec; padding-top: 10px;">
                                                                        <label for="">Express Delivery</label>
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input value="{{ $gigAddon->addon }}"
                                                                               name="gig-addon[{{ $i }}][discription]"
                                                                               type="text"
                                                                               class="form-control {{ ($gigAddon->addon == "Expresslieferung")? 'express': '' }}"
                                                                               placeholder="Enter Addon Discription...">
                                                                        <input value="{{ $gigAddon->id }}"
                                                                               name="gig-addon[{{ $i }}][addon_id]"
                                                                               type="hidden"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                                @if($gigAddon->addon == "Expresslieferung")
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
                                                                <div class="col-md-4">
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
                                                                <div class="col-md-2 del-btn-box">
                                                                    <button data-href="{{ route('gig-addon-remove') }}"
                                                                            type="button"
                                                                            data-addonid="{{ $gigAddon->id }}"
                                                                            class="btn btn-danger btn-xs remove-addon"><span
                                                                                class="fa fa-minus"></span></button>
                                                                </div>
                                                            </div>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                    @else
                                                        {{--<div class="row">--}}
                                                            {{--<div class="col-md-5">--}}
                                                                {{--<div class="form-group">--}}
                                                                    {{--<input value="Gewerbliche Nutzung"--}}
                                                                           {{--name="gig-addon[2][discription]" type="text"--}}
                                                                           {{--class="form-control"--}}
                                                                           {{--placeholder="Enter Addon Discription...">--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-md-5">--}}
                                                                {{--<div class="form-group">--}}
                                                                    {{--<div class="input-group">--}}
                                                                        {{--<span class="input-group-addon">&euro;</span>--}}
                                                                        {{--<input value="50" name="gig-addon[2][price]"--}}
                                                                               {{--type="number" class="form-control">--}}
                                                                        {{--<input name="new_addon[]" type="hidden"--}}
                                                                               {{--value="">--}}
                                                                        {{--<span class="input-group-addon">.00</span>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-md-2 del-btn-box">--}}
                                                                {{--<button type="button"--}}
                                                                        {{--class="btn btn-danger btn-xs remove-addon"><span--}}
                                                                            {{--class="fa fa-minus"></span></button>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <p style="color:#dd4b39; font-weight: bold; font-size: 12px;">Express Delivery (If you want to use this addon plesae add Days, it will effect on your delivery days,otherwise leave it empty)</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input value="Expresslieferung"
                                                                           name="gig-addon[3][discription]" type="text"
                                                                           class="form-control express"
                                                                           placeholder="Enter Addon Discription...">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Days</span>
                                                                        <input type="number" value="" name="gig-addon[3][delivery_day]"
                                                                                class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">&euro;</span>
                                                                        <input value="50" name="gig-addon[3][price]"
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
                                            <div class="box box-info gig-questions-box">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Questions / Fragen</h3>

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
                                                                            class="btn btn-danger btn-xs remove-choice-question"><span
                                                                                class="fa fa-minus"></span></button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Choice Question</label>
                                                                            <input value="{{ $gigQuestion->question }}"
                                                                                   name="gig-choice-question[{{ $i }}][question]"
                                                                                   type="text"
                                                                                   class="form-control"
                                                                                   placeholder="Enter ...">
                                                                            <input value="{{ $gigQuestion->id }}"
                                                                                   name="gig-choice-question[{{ $i }}][question_id]"
                                                                                   type="hidden"
                                                                                   class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label class="green">Choices</label>


                                                                        <?php $answers = explode(',', $gigQuestion->answers) ?>
                                                                        <div class="row answers-container">
                                                                            @foreach($answers as $answer)
                                                                                <div class="col-md-2">
                                                                                    <input value="{{ $answer }}"
                                                                                           class="answer"
                                                                                           name="gig-choice-question[{{ $i }}][answers][]"
                                                                                           style="width:100%"
                                                                                           type="text">
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
                                            <div class="text-center">
                                                @if($update)
                                                    <input class="btn btn-primary btn-lg" type="submit" name="save_only" value="Save & Exit">
                                                    <input class="btn btn-primary btn-lg" type="submit"
                                                            style="margin:10px 0" value="Update & Suggest" name="up_s">
                                                    <a href="{{ route ('gigdetail',['gigType' => $gigtype->slug, 'gig' => $gig->slug ]) }}?funnel={{ $gig->uuid }}"
                                                       class="btn btn-primary btn-lg" target="_blank">View Favor</a>
                                                @else
                                                    <input class="btn btn-primary btn-lg" type="submit" name="save_only" value="Save only">
                                                    <button class="btn btn-primary btn-lg" type="submit"
                                                            style="margin:10px 0">Suggest favor Now
                                                    </button>
                                                @endif
                                            </div>
                                        </form>
                                        @elseif(!empty($type) && $type == 'package')
                                            <form method="post"
                                                  action="{{ (($update) ? route('agency.package.update') : route('Create.Agencypacakge') ) }}"
                                                  enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box box-info">

                                                            <div class="box-body">
                                                                <!-- text input -->
                                                                <div class="row">
                                                                    <div class="col-md-6 form-group">
                                                                        <label>Title</label>
                                                                        <input name="package-title" type="text"
                                                                               value="{{ $update ? $packages->title: Request::old('package-title') }}"
                                                                               class="form-control"
                                                                               placeholder="Enter Package Title...">
                                                                        <input type="hidden"
                                                                               value="{{ $update ? $packages->id: ''}}"
                                                                               name="package_id">
                                                                        @if($errors->has('package-title'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">
                                                                                @if($errors->has('package-title') == "package-title muss mindestens 5 characters.")
                                                                                    Package-title must be at least 5 characters
                                                                                @endif
                                                                                @if($errors->has('package-title') == "Bitte füllen Sie dieses package-title aus")
                                                                                        Please fill out this package-title
                                                                                @endif
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Description (Was Sie benötigen, um den Auftrag zu beginnen / what you need to start the Order)<span style="color:#b299a5; font-weight: 500;"><br>Please explain in a few words what the client need to send you (Maximum 800 characters)</span></span>
                                                                        <span style="padding: 2px 10px; background: #dadbda;border-radius: 15px; display: inline-block;">
                                    <i style="color:#367fa9; position: relative; top: 2px;" tabindex="0" class="fa fa-info" role="button"
                                       data-toggle="popover" data-trigger="focus" data-placement="left"
                                       data-content="copy and paste funtion will work only in the (source code)HTML mode"></i>
                                </span>
                                                                    </label>
                                                                    <textarea id="editor1" name="package-discription"
                                                                              rows="10" cols="80"
                                                                              placeholder="Enter favor Discription...">
                                        {{ ($update) ? $package->pack_desc : Request::old('package-discription') }}
                        </textarea>
                                                                    @if($errors->has('package-discription'))
                                                                        <span class="help-block"
                                                                              style="color:#ff0000">Bitte ergänzen Sie die Package Beschreibung</span>
                                                                        <span class="help-block"
                                                                              style="color:#ff0000">Please complete the Package Description</span>
                                                                    @endif
                                                                    <span class="error-desc1-1"></span>
                                                                    <span class="error-desc1-2"></span>
                                                                </div>
                                                                <!--Assocition-->
                                                                <div class="box box-info">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-group" style="margin-top: 10px;"><label
                                                                                    for="">Select Packages Category</label>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <input type="radio" name="association"
                                                                                   id="radio1" value="cat_assoc" {{ (Request::old('association')) == "cat_assoc" ? 'checked'  : '' }}>
                                                                            <label for="radio1">I have no favor related to this package</label>
                                                                        </div>
                                                                        <div class="col-md-7 form-group">
                                                                            <input type="radio" name="association"
                                                                                   id="radio2" value="favor_assoc"  {{ (Request::old('association')) == "favor_assoc" ? 'checked'  : '' }}>
                                                                            <label for="radio2">Synchronize with my existing favor</label>
                                                                        </div>
                                                                        <div class="col-md-1 form-group"></div>
                                                                        <div class="col-md-12">
                                                                        @if($errors->has('association'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please select favor associaton</span>
                                                                        </div>
                                                                        @endif
                                                                    </div>

                                                            <!--Association by Category  & subcategory-->
                                                                <div id="cat-association" class="col-xs-12" style="{{ (Request::old('association')) == 'cat_assoc' ? 'display:inline-block'  : 'display:none' }}">
                                                                    <div class="row" style="margin:0px 0px;">
                                                                        <div class="form-group cat" style="position: relative;">
                                                                        <label for="categorySelectList">Category / Kategorie</label>
                                                                        <select id="categorySelectList" name="package-category"
                                                                                class="form-control"
                                                                                data-url="{{ route('agency.category.subcategories') }}" style="{{ ($update)? '' :'padding-left: 32px;-webkit-appearance: none;' }};">
                                                                            <option value="">You must select a Category</option>
                                                                            @foreach($categories as $category)
                                                                                <option {{ (($update) ? (($category->id == $gig->gigtype_id) ? 'selected' : '') : (Request::old('package-category') == $category->id) ? 'selected' : '')   }}  value="{{ $category->id }}">{{ $category->name }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        @if(!($update))
                                                                            <i id="warning1" class="fa fa-exclamation" aria-hidden="true" style="color:red; border: 1px solid red; padding: 3px 8px; border-radius: 15px; position: absolute; top:32px; left:5px;"></i>
                                                                        @endif
                                                                        @if($errors->has('gig-category'))
                                                                            {{--<span class="help-block"--}}
                                                                            {{--style="color:#ff0000">{{ $errors->first('gig-category') }}</span>--}}
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Bitte wählen Sie die Favor Kategorie aus</span>
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please select the Category</span>
                                                                        @endif
                                                                    </div>
                                                                    </div>
                                                                    <!-- Subcategory -->
                                                                    <div class="row" style="margin:0px 0px;">
                                                                <div class="form-group" style="position: relative;">
                                                    <span style="margin-bottom: 20px;">
                                                        {{--<label style="float: left;"></label>--}}
                                                        <label style="float: left; margin-left: 10px; margin-bottom: 5px; cursor: pointer;" for="subcat"  data-toggle="modal" data-target="#myModal"><span style="margin-right:10px;">Sub Category / Subkategorie</span>
                                                            @if($errors)
                                                                <span class="help-block"
                                                                      style="color:#ff0000; font-size:12px; display:inline-block"> (At least one Sub Category is required)</span>
                                                            @endif
                                                            <span class="fa fa-plus btn btn-primary btn-xs"></span></label>
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
                                                                            <i id="warning2" class="fa fa-exclamation" aria-hidden="true" style="color:red; border: 1px solid red; padding: 3px 8px; border-radius: 15px; position: absolute; top:60px; left:5px;"></i>
                                                                            <p id="warning-para2" style="color:#9999a2; {{ ($update)? '' :'padding-left: 32px; padding-top:7px' }};">You must select atleast one Sub Category</p>
                                                                        @endif
                                                                    </div>
                                                                    {{--<input type="text" id="subCategorySelectList" class="form-control" data-toggle="modal" data-target="#myModal">--}}
                                                                </div>
                                                                </div>
                                                                </div>
                                                            <!--Assocation by favor-->
                                                                <div class="row" style="{{ (Request::old('association')) == 'favor_assoc' ? 'display:inline-block'  : 'display:none' }}; margin: 0px 15px;" id="favor-assocation">
                                                                    <div class="form-group col-md-6" style="padding:0px;">
                                                                        <label for="favors_associate">Favors List</label>
                                                                        <select name="favor_associate" id="favors_associate" class="form-control">
                                                                            @foreach($agency_favors as $favors)
                                                                                <option value="{{ $favors->id }}" {{ (Request::old('favor_associate')) == $favors->id ? 'selected'  : '' }}>{{ $favors->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                </div>

                                                                <div class="box box-info gig-images-box">
                                                                    <div class="box-header with-border">
                                                                        <label style="margin-left: 10px; cursor: pointer;" for="fileee">
                                                                        <h3 class="box-title image-title"><span><img src="/img/img_thumnail.png" alt="" style="width: 50px; margin-right:10px;">Images / Bilder <span class="red">(750x350)</span>
                                                                            @if(\Illuminate\Support\Facades\Session::has('gig-image'))
                                                                                <span class="help-block"
                                                                                      style="color:#ff0000; font-size:12px; display:inline-block"> ({{ \Illuminate\Support\Facades\Session::get('gig-image') }}
                                                                                    )</span>
                                                                                {{ \Illuminate\Support\Facades\Session::forget('gig-image') }}
                                                                            </span>
                                                                            @endif
                                                                        </h3>
                                                                        <input style="position:absolute;top:0px;left:0px;width:0.1px;height:0.1px;opacity:0;overflow:hidden;"
                                                                               name="gig-images[]" accept="image/*" type="file" multiple
                                                                               id="fileee">
                                                                        <span
                                                                                    class="fa fa-plus btn btn-primary btn-xs"></span></label>
                                                                    </div>

                                                                    <div class="box-body gig-images-box-body">
                                                                        {{--@if($update)--}}
                                                                        @if(!empty($gigImages) && count($gigImages) > 0)
                                                                            @foreach($gigImages as $gigImage)
                                                                                @if(!empty($gigImage))
                                                                                    <div style="position:relative;display:inline-block;">


                                                                                        <button data-href="{{ route('gig.images.remove.agency') }}"
                                                                                                data-image-id="{{  $gigImage->id }}"
                                                                                                style="position:absolute;right:0px;top:0px;padding:0px 6px;"
                                                                                                class="btn btn-default btn-gig-img-remove">x
                                                                                        </button>
                                                                                        <img style="height:60px;"
                                                                                             src="{{ url('/files/gigs/images') . '/' . $gigImage->image }}"
                                                                                             class="meriimage">
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                    <div class="box-footer"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <div class="col-md-12">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th class="text-center">
                                                                        <span style="display:block;"><img src="{{ url('/') .'/img/bronze_label.png' }}" alt="" width="50px"></span>
                                                                        <span style="font-size: 25px;">Bronze</span>
                                                                    </th>
                                                                    <th class="text-center">
                                                                        <span style="display:block;"><img src="{{ url('/') .'/img/silver_label.png' }}" alt="" width="50px"></span>
                                                                        <span style="font-size: 25px;">Silber</span>
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
                                                                        <input type="text" class="form-control" name="platinum_package_name" placeholder="Package Name" value="{{ Request::old('platinum_package_name') }}" maxlength="35">
                                                                        @if($errors->has('platinum_package_name'))
                                                                            <span class="help-block" style="color:#ff0000;">{{ $errors->first('platinum_package_name') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="silver_package_name" placeholder="Package Name" value="{{ Request::old('silver_package_name') }}" maxlength="35">
                                                                        @if($errors->has('silver_package_name'))
                                                                            <span class="help-block" style="color:#ff0000;">{{ $errors->first('silver_package_name') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="gold_package_name" placeholder="Package Name" value="{{ Request::old('gold_package_name') }}" maxlength="35">
                                                                        @if($errors->has('gold_package_name'))
                                                                            <span class="help-block" style="color:#ff0000;">{{ $errors->first('gold_package_name') }}</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Description</td>
                                                                    <td><textarea name="platinum_package_text" id="editor2" cols="30"
                                                                                  rows="4" class="form-control">{{ Request::old('platinum_package_text') }}</textarea>
                                                                        @if($errors->has('platinum_package_text'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">{{ $errors->first('platinum_package_text') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td><textarea name="silver_package_text" id="editor3" cols="30"
                                                                                  rows="4" class="form-control">{{ Request::old('silver_package_text') }}</textarea>
                                                                        @if($errors->has('silver_package_text'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">{{ $errors->first('silver_package_text') }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td><textarea name="gold_package_text" id="editor4" cols="30"
                                                                                  rows="4" class="form-control">{{ Request::old('gold_package_text') }}</textarea>
                                                                        @if($errors->has('gold_package_text'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">{{ $errors->first('gold_package_text') }}</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Days of Delivery</td>
                                                                    <td>
                                                                        <input type="number" class="form-control" name="platinum_days" placeholder="No of days" value="{{ Request::old('platinum_days') }}">
                                                                        @if($errors->has('platinum_days'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please enter the Delivery Days</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control" name="silver_days" placeholder="No of days" value="{{ Request::old('silver_days') }}">
                                                                        @if($errors->has('silver_days'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please enter the Delivery Days</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control" name="gold_days" placeholder="No of days" value="{{ Request::old('gold_days') }}">
                                                                        @if($errors->has('gold_days'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please enter the Delivery Days</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Source File</td>
                                                                    <td class="text-center"><input type="checkbox" name="platinum_source" value="1" {{ Request::old('platinum_source')?'checked' : '' }}></td>
                                                                    <td class="text-center"><input type="checkbox" name="silver_source" value="1" {{ Request::old('silver_source')?'checked' : '' }}></td>
                                                                    <td class="text-center"><input type="checkbox" name="gold_source" value="1" {{ Request::old('gold_source')?'checked' : '' }}></td>
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
                                                                    @if($update)
                                                                    <td>
                                                                        <?php $i = 0;?>
                                                                        @foreach($options as $option)
                                                                            <input name="package-option[]"
                                                                                   type="text" class="form-control"
                                                                                   value="{{ $update ? $option['option']: '' }}"
                                                                                   placeholder="Enter Option...">
                                                                            <input name="option-id{{ $i }}"
                                                                                   type="hidden"
                                                                                   class="form-control"
                                                                                   value="{{ $update ? $option['id']: '' }}"
                                                                                   placeholder="Enter Option...">
                                                                            <?php $i++;?>
                                                                        @endforeach
                                                                    </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <td>Revisions</td>
                                                                    <td>
                                                                        <input type="number" name="platinum_revision" class="form-control" placeholder="No of revision" value="{{ Request::old('platinum_revision') }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="silver_revision" class="form-control" placeholder="No of revisions" value="{{ Request::old('silver_revision') }}">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" name="gold_revision" class="form-control" placeholder="No of revisions" value="{{ Request::old('gold_revision') }}">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Price</td>
                                                                    <td>
                                                                        {{--<input type="number" name="platinum_package_price" class="form-control" placeholder="€" value="{{ Request::old('platinum_package_price') }}">--}}
                                                                        <select name="platinum_package_price" id="" class="form-control">
                                                                            @for($i = 1; $i<=10 ; $i++)
                                                                                <option value="{{ Request::old('platinum_package_price') ? Request::old('platinum_package_price') : $i*10}}">{{ Request::old('platinum_package_price') ? Request::old('platinum_package_price') : $i*10}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        @if($errors->has('platinum_package_price'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please set the Price for Package</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{--<input type="number" name="silver_package_price" class="form-control" placeholder="€" value="{{ Request::old('silver_package_price') }}">--}}
                                                                        <select name="silver_package_price" id="" class="form-control">
                                                                            @for($i = 110; $i<=200 ; $i+=10)
                                                                                <option value="{{ Request::old('silver_package_price') ? Request::old('silver_package_price') : $i}}">{{ Request::old('silver_package_price') ? Request::old('silver_package_price') : $i}}</option>
                                                                            @endfor
                                                                        </select>
                                                                        @if($errors->has('silver_package_price'))
                                                                            <span class="help-block"
                                                                                  style="color:#ff0000">Please set the Price for Package</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{--<input type="number" name="gold_package_price" class="form-control" placeholder="€" value="{{ Request::old('gold_package_price') }}">--}}
                                                                        <select name="gold_package_price" id="" class="form-control">
                                                                            @for($i = 210; $i<=300 ; $i+=10)
                                                                                <option value="{{ Request::old('gold_package_price') ? Request::old('gold_package_price') : $i}}">{{ Request::old('gold_package_price') ? Request::old('gold_package_price') : $i}}</option>
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
                                                <div class="text-center" style="margin-bottom: 10px;">
                                                    @if(isset($update) && $update)
                                                        <button name="update-package" class="btn btn-primary btn-lg"
                                                                type="submit">Update
                                                        </button>
                                                        <button class="btn btn-primary btn-lg"
                                                                type="button">View Package
                                                        </button>
                                                    @else
                                                        <input name="save_package" class="btn btn-primary btn-lg"
                                                               type="submit" value="Save Only">
                                                        <input name="create_package" class="btn btn-primary btn-lg"
                                                                type="submit" value="Suggest Package Now">
                                                    @endif
                                                </div>
                                            </form>
                                        @endif
                                </form>
                    </div>

                </div>
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
                    <span style="display: inline-block; position: absolute; right: 40px; top: 10px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary checked-cat" data-dismiss="modal">select / auswählen</button>
                    </span>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary checked-cat" data-dismiss="modal">select / auswählen</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('pages_css')

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/select2/select2.min.css') }}">

@endsection
@section('pages_script')
    <script type="text/javascript">
        $(".fa-info").popover({
            'trigger': 'hover'
        })
    </script>
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <!-- CK Editor -->
    <script type="text/javascript" src="{{ asset('bower_components/AdminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
    
    {{--<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>--}}
    <script type="text/javascript">
        $(document).ready(function(){
            $(".form-group input.express").on("keydown keypress keyup", false);
        });
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
            CKEDITOR.replace('editor4', {wordcount: wordCountConf3,customConfig: source});
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
    <!-- Bootstrap WYSIHTML5 -->
    <script>
        tinymce.init({
            selector: '#gigDiscription'
        });
    </script>
    <script>
        (function () {
            var count = 0;
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
    {{--<script type="text/javascript" src="{{ asset('bower_components/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>--}}
    <script type="text/javascript">
        (function () {
            $('#gig_submit').submit(function(e){
                var editorData = CKEDITOR.instances.editor1.getData();
                var editorData2 = CKEDITOR.instances.editor2.getData();
                var editorData3 = CKEDITOR.instances.editor3.getData();
                var dev = $("#subcat_tagsinput");
                var fiedl1 = $(".favor-title").val();
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
                if(fiedl1 == ""){
                    e.preventDefault();
                    $('.error-block1').html('<p style="color:red;">Bitte wählen Sie eine favor-title aus</p>');
                    $('.error-block2').html('<p style="color:red;">Please choose a favor-title from</p>');
                }
                if(editorData == ""){
                    $(".error-desc1-1").html('<p style="color:red">Bitte ergänzen Sie die Favor Beschreibung</p>');
                    $(".error-desc1-2").html('<p style="color:red">Pleaes complete the Favor Description</p>');

                }
                if(editorData2 == ""){
                    $(".error-desc2-1").html('<p style="color:red">Bitte ergänzen Sie die Favor Beschreibung</p>');
                    $(".error-desc2-2").html('<p style="color:red">Pleaes complete the Favor Description</p>');
                }
                if(editorData3 == ""){
                    $(".error-desc3-1").html('<p style="color:red">Bitte ergänzen Sie die Favor Beschreibung</p>');
                    $(".error-desc3-2").html('<p style="color:red">Pleaes complete the Favor Description</p>');
                }
            });
            $('#gig-submit').submit(function(e){
                var dev = $("#subcat_tagsinput");
                var numFiles = $("input:file",this)[0].files.length;
                if( !$.trim( dev.html() ).length ){
                    e.preventDefault();
                    $('.error').html('Please select at least one sub category');
                }
            });
            $('#gig-submit').submit(function(e){
                var dev = $(".favor-title").val();
                if(dev == ""){
                    e.preventDefault();
                   alert("error!");
                }
            });
            var grab_sel_cat = $('#categorySelectList');
            var grab_sel_val = grab_sel_cat.val();
            var grab_sel_opt = $('#subCategorySelectList').data('select-id');
            if(grab_sel_val != ""){
                $.ajax({
                    url: "{{ route('agency.category.subcategories') }}" + '?cat-id=' + grab_sel_val,
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
            /*<!--Package Photos-->
            document.querySelector('#file_package').addEventListener('change', function () {
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
                                $("#file_package").val("");
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
            });*/

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
                /*alert($(this).data('addonid'));*/
                var add_id = $(this).data('addonid');
                var addon = $(this);
                $.ajax({

                    method: 'post',
                    url: $(this).data('href'),
                    data: {gigadonid: add_id},
                    success: function (data, status) {
                        if (data.result == true) {
                            addon.parent().parent().remove();

                        }
                    }


                });


            });


           /* $(".select2").select2({
                tags: true,
                tokenSeparators: [','],
                maximumSelectionSize: 0,
            });
            $('.select2-selection__rendered').prepend('<li class="select2-selection__choice" title="hello"><span class="select2-selection__choice__remove" role="presentation">×</span>hello</li>');
            $('.select2-hidden-accessible').prepend('<option value="hello" data-select2-tag="true">hello</option>');*/


        })();
//        (function () {
//            var get_old_sub_id = $('#subCategorySelectList').data('old-sel-id');
//            var get_parent_id = $('#subCategorySelectList').data('old-par-id');
//            var ajax_url = $('#categorySelectList').data('url');
//            $.ajax({
//                url: ajax_url + '?cat-id=' + get_parent_id,
//                method: 'get',
//                success: function (data) {
//                    var cats = '<option value="">Select Sub Category</option>';
//                    data.forEach(function (element, index, array) {
//                        if (get_old_sub_id == element.id) {
//                            cats += '<option value="' + element.id + '" selected>' + element.name + '</option>';
//                        } else {
//                            cats += '<option value="' + element.id + '">' + element.name + '</option>';
//                        }
//                    });
//
//                    $('#subCategorySelectList').html(cats);
//                }
//            });
//
//
//            $('#categorySelectList').change(function (e) {
//
//                var cat = $(this);
//                var catId = cat.val();
//
//                $.ajax({
//                    url: cat.data('url') + '?cat-id=' + catId,
//                    method: 'get',
//                    success: function (data) {
//                        var cats = '<option value="">Select Sub Category</option>';
//                        data.forEach(function (element, index, array) {
//                            cats += '<option value="' + element.id + '">' + element.name + '</option>';
//                        });
//
//                        $('#subCategorySelectList').html(cats);
//                    }
//                });
//
//            });
//
//
//            document.querySelector('#fileee').addEventListener('change', function () {
//                var files = this.files;
//                var imageBox = document.querySelector('.gig-images-box .box-body');
//                var imageBoxFooter = $('.gig-images-box .box-footer');
//                var img_valid_arr = [];
//                $('.gig-images-box .box-body').find('img.new_up').remove();
//
//
//                if (files.length > 0) {
//                    imageBoxFooter.html('');
//                    for (var i = 0; i < files.length; i++) {
//                        var load_img = new Image();
//                        load_img.onload = function () {
//                            var height = this.height;
//                            var width = this.width;
//                            if (width == 750 && height == 350) {
//                                var imgElement = document.createElement('img');
//                                imgElement.className = 'meriimage new_up';
//                                imgElement.height = 60;
//                                imgElement.src = this.src;
//                                imgElement.onload = function () {
//                                    window.URL.revokeObjectURL(imgElement.src);
//                                };
//                                imageBox.appendChild(imgElement);
//                            } else {
//                                img_valid_arr.push('not valid');
//                            }
//
//                            var sub = files.length - img_valid_arr.length;
//
//                            console.log(sub);
//
//                            var selc_cont = (sub == 0) ? '<p>No image selected.</p>' : '<p>' + sub + ' image selected.</p>';
//
//                            if (img_valid_arr.length > 0) {
//                                imageBoxFooter.html(selc_cont+'<p style="color:red;">The image dimensions should be: 750 width and 350 height</p>');
//                                $("#fileee").val("");
//                            } else {
//                                imageBoxFooter.html(selc_cont);
//                            }
//                        };
//                        load_img.src = window.URL.createObjectURL(files[i]);
//                    }
//                } else {
//                    imageBoxFooter.html('');
//                    imageBoxFooter.html('<p>No image selected.</p>');
//                }
//
//
//            });
//
//
//            document.querySelector('#add-new-addon').addEventListener('click', addAddon);
//            document.querySelector('#add-choice-question').addEventListener('click', addChoiceQuestion);
//            document.querySelector('#add-range-question').addEventListener('click', addRangeQuestion);
//            $('.btn-gig-img-remove').click(function (e) {
//                e.preventDefault();
//                if (!confirm('Are you sure you want to delete this image?')) {
//                    return false;
//                }
//                // console.log('Test');
//                //alert($(this).attr('href'));
//                else {
//                    var obj = $(this);
//                    $.ajax({
//
//                        method: 'post',
//                        url: $(this).data('href'),
//                        data: {gigimage_id: $(this).data('image-id')},
//                        success: function (data) {
//                            console.log(data);
//
//                            if (data.result == true) {
//
//                                obj.parent().remove();
//                            }
//                            else {
//
//                            }
//                        }
//                    });
//
//                }
//            });
//
//            $('.remove-addon').click(function (e) {
//
//                e.preventDefault();
//                var addon = $(this);
//                $.ajax({
//
//                    method: 'post',
//                    url: $(this).data('href'),
//                    data: {gigadonid: $(this).data('addonid')},
//                    success: function (data) {
//
//                        if (data.result == true) {
//                            addon.parent().parent().remove();
//
//                        }
//                    }
//
//
//                });
//
//
//            });
//
//
//            $(".select2").select2({
//                tags: true,
//                tokenSeparators: [','],
//                maximumSelectionSize: 0,
//            });
//            $('.select2-selection__rendered').prepend('<li class="select2-selection__choice" title="hello"><span class="select2-selection__choice__remove" role="presentation">×</span>hello</li>');
//            $('.select2-hidden-accessible').prepend('<option value="hello" data-select2-tag="true">hello</option>');
//
//
//        })();


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
                    '<div class="multi-field-wrapper">'+
                    '<div class="multi-fields">'+
                    '<div class="multi-field col-md-3">'+
                    '<input type="text" class="form-control" name="' + choiceQuestionChangeName3(this) + '[]" style="display: inline; width: 80%;">'+
                    '<span class="remove-field btn btn-danger" style="float: right;">-</span>'+
                    '</div>'+
                    '</div>'+
                    '<div class="col-md-2">'+
                    '<button type="button" class="add-field btn btn-primary">Add more choices</button>'+
                    '</div>'+
                    '</div>'+
                    '</div>' +
                    '</div>');


            $('.gig-questions-box .box-body').append(newChoiceQuestion);
            addinput();
            var removeBtns = document.querySelectorAll('.remove-choice-question');

            for (var i = 0; i < removeBtns.length; i++) {
                removeBtns[i].addEventListener('click', removeChoiceQuestion);
            }


          /*  $(".select2").select2({
                tags: true,
                tokenSeparators: [',', ' '],
                maximumSelectionSize: 0,
            });*/

        }

        function removeChoiceQuestion() {

            this.parentNode.parentNode.remove();

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

