@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Add Slider to Home Page</h1>

@endsection




@section('content')

    <style>
        .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
            background: transparent;
            color: #444;
        }

        .nav-pills>li>a span.rem_sld{
            display: none;
        }

        .nav-pills>li>a:hover span.rem_sld{
            display: block;
        }

        .ajaxLoaderCon{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.8);
            z-index: 999;
            display: none;
        }

        .ss_boxFull{
            display: table;
            width: 100%;
            height: 100%;
        }

        .ss_verMid{
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .txt-sh-css{
            display: inline-block;
            min-width: 0;
            width: 50px;
            padding: 0;
            height: 34px;
            line-height: 34px;
            text-align: center;
        }
        .txt-sh-css.color{
            width: 100%;
            display: block;
            margin-bottom: 5px;
        }
        .dis_block{
            display: block;
        }
    </style>
    <?php
    $style = (!empty($imgages[0]->txt_style)) ? json_decode($imgages[0]->txt_style) : "";
    $stl_tit1 = "";
    $stl_tit2 = "";
    if (!empty($style)) {
        $stl_tit1 = $style->stl_tit1;
        $stl_tit2 = $style->stl_tit2;
    }
    ?>
    <div style="position:relative;">
        <div class="ajaxLoaderCon">
            <div class="ss_boxFull">
                <div class="ss_verMid">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw" style="color: #fff;"></i>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 20px;">
            <button class="btn btn-info" type="button" id="addSlideBtn">Add Slide</button>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3" style="border-right: 3px solid #00c0ef;background-color: white;">
                    <div class="row">
                        <ul class="nav nav-pills nav-stacked" id="sld_menu_l">
                            <?php
                            if (!empty($imgages) && is_array($imgages)) {
                                $i = 0;
                                foreach ($imgages as $s_data) {
                                    ?>
                                <li <?=($i < 1)? "class='active'":"" ?>><a href="#" data-sld-info='<?=json_encode($s_data)?>'><span><?=(!empty($s_data->slide_title))? $s_data->slide_title: "Slide ".($i+1)?></span><span class="pull-right rem_sld"><i class="fa fa-times-circle" aria-hidden="true"></i></span></a></li>
<?php
                                    $i++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 style="margin-top: 5px;margin-bottom: 5px;" id="sld_content_pg_heading">Slide 1</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sld_c_title1">Slide Title 1</label>
                                        <input type="text" class="form-control" placeholder="Title 1" id="sld_c_title1" value="<?=(!empty($imgages[0]->title)) ? $imgages[0]->title:'' ?>" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit1_align_css">Text Alignment</label>
                                        <select class="form-control" id="tit1_align_css">
                                            <option value="" <?=(!empty($stl_tit1->align) ? (($stl_tit1->align == "") ? "selected":""): "")?>>Select Text Alignment</option>
                                            <option value="left" <?=(!empty($stl_tit1->align) ? (($stl_tit1->align == "left") ? "selected":""): "")?>>Left</option>
                                            <option value="right" <?=(!empty($stl_tit1->align) ? (($stl_tit1->align == "right") ? "selected":""): "")?>>Right</option>
                                            <option value="center" <?=(!empty($stl_tit1->align) ? (($stl_tit1->align == "center") ? "selected":""): "")?>>Center</option>
                                            <option value="justify" <?=(!empty($stl_tit1->align) ? (($stl_tit1->align == "justify") ? "selected":""): "")?>>Justify</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit1_shadow_color_css" class="dis_block">Text Shadow</label>
                                        <input type="text" class="form-control txt-sh-css color" value="<?=(!empty($stl_tit1->shadow_color) ? $stl_tit1->shadow_color: "rgb(255, 255, 255)")?>" id="tit1_shadow_color_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->shadow_top) ? $stl_tit1->shadow_top: "")?>" placeholder="Top" id="tit1_shadow_top_v_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->shadow_left) ? $stl_tit1->shadow_left: "")?>" placeholder="Left" id="tit1_shadow_left_v_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->shadow_blur) ? $stl_tit1->shadow_blur: "")?>" placeholder="Blur" id="tit1_shadow_spr_v_css" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit1_txt_color_css" class="dis_block">Text Color</label>
                                        <input type="text" class="form-control txt-sh-css color" value="<?=(!empty($stl_tit1->txt_color) ? $stl_tit1->txt_color: "rgb(255, 255, 255)")?>" id="tit1_txt_color_css" />
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="tit1_txt_size_css">Text Size</label>
                                        <input type="text" class="form-control" value="<?=(!empty($stl_tit1->txt_size) ? $stl_tit1->txt_size: "")?>" id="tit1_txt_size_css" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit1_txt_pos_l_css" class="dis_block">Text Position</label>
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->txt_pos_l) ? $stl_tit1->txt_pos_l: "")?>" placeholder="Left" id="tit1_txt_pos_l_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->txt_pos_r) ? $stl_tit1->txt_pos_r: "")?>" placeholder="Right" id="tit1_txt_pos_r_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->txt_pos_t) ? $stl_tit1->txt_pos_t: "")?>" placeholder="Top" id="tit1_txt_pos_t_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit1->txt_pos_b) ? $stl_tit1->txt_pos_b: "")?>" placeholder="Bottom" id="tit1_txt_pos_b_css" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sld_c_title2">Slide Title 2</label>
                                        <input type="text" class="form-control" placeholder="Title 2" id="sld_c_title2" value="<?=(!empty($imgages[0]->title2)) ? $imgages[0]->title2:'' ?>" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit2_align_css">Text Alignment</label>
                                        <select class="form-control" id="tit2_align_css">
                                            <option value="" <?=(!empty($stl_tit2->align) ? (($stl_tit2->align == "") ? "selected":""): "")?>>Select Text Alignment</option>
                                            <option value="left" <?=(!empty($stl_tit2->align) ? (($stl_tit2->align == "left") ? "selected":""): "")?>>Left</option>
                                            <option value="right" <?=(!empty($stl_tit2->align) ? (($stl_tit2->align == "right") ? "selected":""): "")?>>Right</option>
                                            <option value="center" <?=(!empty($stl_tit2->align) ? (($stl_tit2->align == "center") ? "selected":""): "")?>>Center</option>
                                            <option value="justify" <?=(!empty($stl_tit2->align) ? (($stl_tit2->align == "justify") ? "selected":""): "")?>>Justify</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit2_shadow_color_css" class="dis_block">Text Shadow</label>
                                        <input type="text" class="form-control txt-sh-css color" value="<?=(!empty($stl_tit2->shadow_color) ? $stl_tit2->shadow_color: "rgb(255, 255, 255)")?>" id="tit2_shadow_color_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->shadow_top) ? $stl_tit2->shadow_top: "")?>" placeholder="Top" id="tit2_shadow_top_v_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->shadow_left) ? $stl_tit2->shadow_left: "")?>" placeholder="Left" id="tit2_shadow_left_v_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->shadow_blur) ? $stl_tit2->shadow_blur: "")?>" placeholder="Blur" id="tit2_shadow_spr_v_css" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit2_txt_color_css" class="dis_block">Text Color</label>
                                        <input type="text" class="form-control txt-sh-css color" value="<?=(!empty($stl_tit2->txt_color) ? $stl_tit2->txt_color: "rgb(255, 255, 255)")?>" id="tit2_txt_color_css" />
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="tit2_txt_size_css">Text Size</label>
                                        <input type="text" class="form-control" value="<?=(!empty($stl_tit2->txt_size) ? $stl_tit2->txt_size: "")?>" id="tit2_txt_size_css" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tit2_txt_pos_l_css" class="dis_block">Text Position</label>
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->txt_pos_l) ? $stl_tit2->txt_pos_l: "")?>" placeholder="Left" id="tit2_txt_pos_l_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->txt_pos_r) ? $stl_tit2->txt_pos_r: "")?>" placeholder="Right" id="tit2_txt_pos_r_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->txt_pos_t) ? $stl_tit2->txt_pos_t: "")?>" placeholder="Top" id="tit2_txt_pos_t_css" />
                                        <input type="text" class="form-control txt-sh-css" value="<?=(!empty($stl_tit2->txt_pos_b) ? $stl_tit2->txt_pos_b: "")?>" placeholder="Bottom" id="tit2_txt_pos_b_css" />
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="">
                                    <img src="{{ (!empty($imgages[0]->image_name)) ? url('/files/slider_images') . '/' . $imgages[0]->image_name : '' }}" style="width: 100%;<?=(!empty($imgages[0]->image_name)) ? '': 'display:none;'?>" id="sld_c_img" />
                                </div>
                                <div style="margin-top: 15px">
                                    <p id="img_sel_err" style="{{ (!empty($imgages[0]->image_name)) ? 'display:none;' : '' }}">No Image Found!</p>
                                    <input type="button" class="btn btn-info" value="Change Image" id="sld_img_rel_btn" />
                                    <input type="file" accept="image/*" id="sld_img_sel" style="display: none;" />
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div>
                                <input type="button" id="sld_c_save" class="btn btn-primary" name="submit" value="Save Slide">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@section('pages_script')

    <script type="text/javascript" src="{{ url("js/jqColorPicker.min.js") }}"></script>
    <script>
        (function($){
            var style = {"stl_tit1":{},"stl_tit2":{}};

            function putJsonStyle(main_json, json_key, json_key_sep, json_inp_val){
                if(json_inp_val != ""){
                    main_json[json_key][json_key_sep] = json_inp_val;
                }else{
                    delete main_json[json_key][json_key_sep];
                }
            }

            function setInputval(elem, obj, obj_key, def_val){
                if (obj.hasOwnProperty(obj_key) && obj[obj_key] != null) {
                    elem.val(obj[obj_key]);
                }else{
                    elem.val(def_val);
                }
            }

            $("#sld_menu_l").on("click", "li a span.rem_sld", function () {
                var par_sel = $(this).parent().parent();
                var progLoadCon = $(".ajaxLoaderCon");
                if (!confirm("Are you sure! You want to delete this slider.")) {
                    return false;
                } else {
                    var sld_info = JSON.parse($(this).parent().attr("data-sld-info"));
                    if (sld_info.hasOwnProperty("id")) {
                        progLoadCon.show();
                        $.ajax({
                            method: 'post',
                            data: {'id': sld_info.id},
                            url: "{{ route('slideRemove') }}",
                            dataType: "json",
                            success: function (data) {
                                if (data.res == "success") {
                                    par_sel.remove();
                                    var slide_menu_list = $("#sld_menu_l");
                                    slide_menu_list.find("li:eq(0) a").trigger("click");
                                    var inc = 0;
                                    slide_menu_list.find("li").each(function () {
                                        inc++;
                                        var grab_a = $(this).find("a span:eq(0)");
                                        grab_a.html("Slide " + inc);
                                    });
                                } else {
                                    console.log(data);
                                }
                                progLoadCon.fadeOut();
                            }
                        });
                    }
                }
                return false;
            });

            $('.color').colorPicker();

            $("#sld_menu_l").on("click", "li a", function (e) {
                e.preventDefault();
                if (!$(this).parent().hasClass("active")) {
                    $(this).parent().parent().find("li").removeClass("active");
                    $(this).parent().addClass("active");
                    $("#sld_content_pg_heading").html($(this).find("span:eq(0)").html());

                    var sld_c_img = $("#sld_c_img");
                    var sld_img_sel_file = $("#sld_img_sel");
                    sld_img_sel_file.replaceWith(sld_img_sel_file.val("").clone(true));

                    // element select title 1
                    var sld_c_title1 = $("#sld_c_title1");
                    var tit1_aln_sel = $("#tit1_align_css");
                    var tit1_shd_color_sel = $("#tit1_shadow_color_css");
                    var tit1_shd_top_sel = $("#tit1_shadow_top_v_css");
                    var tit1_shd_left_sel = $("#tit1_shadow_left_v_css");
                    var tit1_shd_blur_sel = $("#tit1_shadow_spr_v_css");
                    var tit1_txt_color_sel = $("#tit1_txt_color_css");
                    var tit1_txt_size_sel = $("#tit1_txt_size_css");
                    var tit1_txt_pos_l_sel = $("#tit1_txt_pos_l_css");
                    var tit1_txt_pos_r_sel = $("#tit1_txt_pos_r_css");
                    var tit1_txt_pos_t_sel = $("#tit1_txt_pos_t_css");
                    var tit1_txt_pos_b_sel = $("#tit1_txt_pos_b_css");

                    // element select title 1
                    var sld_c_title2 = $("#sld_c_title2");
                    var tit2_aln_sel = $("#tit2_align_css");
                    var tit2_shd_color_sel = $("#tit2_shadow_color_css");
                    var tit2_shd_top_sel = $("#tit2_shadow_top_v_css");
                    var tit2_shd_left_sel = $("#tit2_shadow_left_v_css");
                    var tit2_shd_blur_sel = $("#tit2_shadow_spr_v_css");
                    var tit2_txt_color_sel = $("#tit2_txt_color_css");
                    var tit2_txt_size_sel = $("#tit2_txt_size_css");
                    var tit2_txt_pos_l_sel = $("#tit2_txt_pos_l_css");
                    var tit2_txt_pos_r_sel = $("#tit2_txt_pos_r_css");
                    var tit2_txt_pos_t_sel = $("#tit2_txt_pos_t_css");
                    var tit2_txt_pos_b_sel = $("#tit2_txt_pos_b_css");

                    sld_c_img.attr("src", "");
                    sld_c_img.hide();

                    var imgErrField = $("#img_sel_err");
                    imgErrField.html("No Image Found!");

                    var sld_info = JSON.parse($(this).attr("data-sld-info"));
                    var sld_style_info = "";
                    var sld_style_tit1_info = "";
                    var sld_style_tit2_info = "";
                    if(sld_info.hasOwnProperty("txt_style") && sld_info["txt_style"] != null){
                        sld_style_info = JSON.parse(sld_info.txt_style);
                        sld_style_tit1_info = sld_style_info.stl_tit1;
                        sld_style_tit2_info = sld_style_info.stl_tit2;
                    }

                    // set style values title 1
                    setInputval(sld_c_title1, sld_info, "title", "");
                    setInputval(tit1_aln_sel, sld_style_tit1_info, "align", "");
                    setInputval(tit1_shd_color_sel, sld_style_tit1_info, "shadow_color", "rgb(255, 255, 255)");
                    setInputval(tit1_txt_color_sel, sld_style_tit1_info, "txt_color", "rgb(255, 255, 255)");
                    setInputval(tit1_shd_top_sel, sld_style_tit1_info, "shadow_top", "");
                    setInputval(tit1_shd_left_sel, sld_style_tit1_info, "shadow_left", "");
                    setInputval(tit1_shd_blur_sel, sld_style_tit1_info, "shadow_blur", "");
                    setInputval(tit1_txt_size_sel, sld_style_tit1_info, "txt_size", "");
                    setInputval(tit1_txt_pos_l_sel, sld_style_tit1_info, "txt_pos_l", "");
                    setInputval(tit1_txt_pos_r_sel, sld_style_tit1_info, "txt_pos_r", "");
                    setInputval(tit1_txt_pos_t_sel, sld_style_tit1_info, "txt_pos_t", "");
                    setInputval(tit1_txt_pos_b_sel, sld_style_tit1_info, "txt_pos_b", "");

                    // set style values title 2
                    setInputval(sld_c_title2, sld_info, "title2", "");
                    setInputval(tit2_aln_sel, sld_style_tit2_info, "align", "");
                    setInputval(tit2_shd_color_sel, sld_style_tit2_info, "shadow_color", "rgb(255, 255, 255)");
                    setInputval(tit2_txt_color_sel, sld_style_tit2_info, "txt_color", "rgb(255, 255, 255)");
                    setInputval(tit2_shd_top_sel, sld_style_tit2_info, "shadow_top", "");
                    setInputval(tit2_shd_left_sel, sld_style_tit2_info, "shadow_left", "");
                    setInputval(tit2_shd_blur_sel, sld_style_tit2_info, "shadow_blur", "");
                    setInputval(tit2_txt_size_sel, sld_style_tit2_info, "txt_size", "");
                    setInputval(tit2_txt_pos_l_sel, sld_style_tit2_info, "txt_pos_l", "");
                    setInputval(tit2_txt_pos_r_sel, sld_style_tit2_info, "txt_pos_r", "");
                    setInputval(tit2_txt_pos_t_sel, sld_style_tit2_info, "txt_pos_t", "");
                    setInputval(tit2_txt_pos_b_sel, sld_style_tit2_info, "txt_pos_b", "");

                    $(".color").each(function(){
                        $(this).css({"background-color":"white", "color":"black"});
                    });

                    if (sld_info.hasOwnProperty("image_name") && sld_info.image_name != null) {
                        sld_c_img.attr("src", "{{ url('/files/slider_images')."/" }}" + sld_info.image_name);
                        if(sld_c_img.css("display") == "none"){
                            sld_c_img.show();
                        }
                        imgErrField.hide();
                    }else{
                        imgErrField.show();
                    }
                }
            });

            $("#addSlideBtn").on("click", function(){
                var _self = $(this);
                var o_text = _self.html();
                var progLoadCon = $(".ajaxLoaderCon");
                _self.attr("disabled", "disabled");
                _self.html('<i class="fa fa-refresh fa-spin fa-fw"></i>');
                progLoadCon.show();
                $.ajax({
                    method: 'post',
                    data: {'newAdd': "true"},
                    url: "{{ route('addNewSlider') }}",
                    success:function(data){
                        if(data == "error"){
                            console.log(data);
                        }else{
                            var sld_p_list = $("#sld_menu_l");
                            var tot_li_c = sld_p_list.find("li").length;
                            var ap_str = "<li><a href='#' data-sld-info='{\"id\":" + data + "}'><span>Slide " + (tot_li_c + 1) + "</span><span class='pull-right rem_sld'><i class='fa fa-times-circle' aria-hidden='true'></i></span></a></li>";
                            sld_p_list.append(ap_str);
                        }
                        _self.removeAttr("disabled");
                        _self.html(o_text);
                        progLoadCon.fadeOut();
                    }
                });
            });
            $("#sld_img_rel_btn").on("click", function(){
                $("#sld_img_sel").trigger("click");
            });
            $("#sld_img_sel").on("change", function(){
                var file_field = $(this);
                var file_img = file_field[0].files[0];
                var sld_c_img = $("#sld_c_img");
                var imgErrField = $("#img_sel_err");
                sld_c_img.attr("src", "");
                sld_c_img.hide();
                imgErrField.html("No Image Found!").hide();
                if(typeof file_img !== "undefined"){
                    var load_img = new Image();
                    load_img.onload = function(){
                        var height = this.height;
                        var width = this.width;
                        //console.log(width+" -- "+height+"----"+this.src);
                        if(width >= 1600 && height == 490){
                            sld_c_img.attr("src", this.src);
                            sld_c_img.show();
                        }else{
                            file_field.replaceWith(file_field.val("").clone(true));
                            imgErrField.html("The image dimensions should be: greater than or equal to 1600 width and 490 height fixed.").show();
                        }
                    };
                    load_img.src = window.URL.createObjectURL(file_img);
                }else{
                    imgErrField.show();
                }
            });

            $("#sld_c_save").on("click", function(){
                var sld_c_title = $("#sld_c_title1");
                var sld_c_title2 = $("#sld_c_title2");
                var sld_c_file_field = $("#sld_img_sel");
                var sld_menu_list = $("#sld_menu_l");
                var sel_sld = sld_menu_list.find("li.active a");
                var getSlideInfo = JSON.parse(sel_sld.attr("data-sld-info"));
                var file_val = sld_c_file_field[0].files[0];
                var send_file = "", send_title1 = sld_c_title.val(), send_title2 = sld_c_title2.val();
                if(typeof file_val !== "undefined"){
                    send_file = file_val;
                }

                // set title 1 style
                var tit1_aln_val = $("#tit1_align_css").find("option:selected").val();
                var tit1_shd_color_val = $("#tit1_shadow_color_css").val();
                var tit1_shd_top_val = $("#tit1_shadow_top_v_css").val();
                var tit1_shd_left_val = $("#tit1_shadow_left_v_css").val();
                var tit1_shd_blur_val = $("#tit1_shadow_spr_v_css").val();
                var tit1_txt_color_val = $("#tit1_txt_color_css").val();
                var tit1_txt_size_val = $("#tit1_txt_size_css").val();
                var tit1_txt_pos_l_val = $("#tit1_txt_pos_l_css").val();
                var tit1_txt_pos_r_val = $("#tit1_txt_pos_r_css").val();
                var tit1_txt_pos_t_val = $("#tit1_txt_pos_t_css").val();
                var tit1_txt_pos_b_val = $("#tit1_txt_pos_b_css").val();

                putJsonStyle(style, "stl_tit1", "align", tit1_aln_val);
                putJsonStyle(style, "stl_tit1", "shadow_color", tit1_shd_color_val);
                putJsonStyle(style, "stl_tit1", "shadow_top", tit1_shd_top_val);
                putJsonStyle(style, "stl_tit1", "shadow_left", tit1_shd_left_val);
                putJsonStyle(style, "stl_tit1", "shadow_blur", tit1_shd_blur_val);
                putJsonStyle(style, "stl_tit1", "txt_color", tit1_txt_color_val);
                putJsonStyle(style, "stl_tit1", "txt_size", tit1_txt_size_val);
                putJsonStyle(style, "stl_tit1", "txt_pos_l", tit1_txt_pos_l_val);
                putJsonStyle(style, "stl_tit1", "txt_pos_r", tit1_txt_pos_r_val);
                putJsonStyle(style, "stl_tit1", "txt_pos_t", tit1_txt_pos_t_val);
                putJsonStyle(style, "stl_tit1", "txt_pos_b", tit1_txt_pos_b_val);

                // set title 2 style
                var tit2_aln_val = $("#tit2_align_css").find("option:selected").val();
                var tit2_shd_color_val = $("#tit2_shadow_color_css").val();
                var tit2_shd_top_val = $("#tit2_shadow_top_v_css").val();
                var tit2_shd_left_val = $("#tit2_shadow_left_v_css").val();
                var tit2_shd_blur_val = $("#tit2_shadow_spr_v_css").val();
                var tit2_txt_color_val = $("#tit2_txt_color_css").val();
                var tit2_txt_size_val = $("#tit2_txt_size_css").val();
                var tit2_txt_pos_l_val = $("#tit2_txt_pos_l_css").val();
                var tit2_txt_pos_r_val = $("#tit2_txt_pos_r_css").val();
                var tit2_txt_pos_t_val = $("#tit2_txt_pos_t_css").val();
                var tit2_txt_pos_b_val = $("#tit2_txt_pos_b_css").val();

                putJsonStyle(style, "stl_tit2", "align", tit2_aln_val);
                putJsonStyle(style, "stl_tit2", "shadow_color", tit2_shd_color_val);
                putJsonStyle(style, "stl_tit2", "shadow_top", tit2_shd_top_val);
                putJsonStyle(style, "stl_tit2", "shadow_left", tit2_shd_left_val);
                putJsonStyle(style, "stl_tit2", "shadow_blur", tit2_shd_blur_val);
                putJsonStyle(style, "stl_tit2", "txt_color", tit2_txt_color_val);
                putJsonStyle(style, "stl_tit2", "txt_size", tit2_txt_size_val);
                putJsonStyle(style, "stl_tit2", "txt_pos_l", tit2_txt_pos_l_val);
                putJsonStyle(style, "stl_tit2", "txt_pos_r", tit2_txt_pos_r_val);
                putJsonStyle(style, "stl_tit2", "txt_pos_t", tit2_txt_pos_t_val);
                putJsonStyle(style, "stl_tit2", "txt_pos_b", tit2_txt_pos_b_val);

                var send_style = JSON.stringify(style);

                var formData = new FormData();
                formData.append('update', getSlideInfo.id);
                formData.append('title1', send_title1);
                formData.append('title2', send_title2);
                formData.append('style', send_style);
                formData.append('image', send_file);

                var progLoadCon = $(".ajaxLoaderCon");
                progLoadCon.show();
                $.ajax({
                    type: 'post',
                    data: formData,
                    url: "{{ route('addNewSlider') }}",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success:function(data){
                        if(data.hasOwnProperty("res")){
                            sel_sld.attr("data-sld-info",JSON.stringify(data.res));
                        }else{
                            console.log(data);
                        }
                        progLoadCon.fadeOut();
                    }
                });
            });

        })(jQuery);
    </script>
    <script>
        (function() {
            $('#btnAddMoreSubcategory').click(function(e) {
                var subCategory = '<div class="col-md-2 form-group"><input name="subcategories[]" type="text" class="form-control" placeholder="Enter Subcategory Name..." style="float: left; width: 224px;position: relative;">';
                subCategory +='<input name="subcategoriesid[]" type="hidden" class="form-control" placeholder="Enter Subcategory Name...">' +
                        '<button type="button" class="btn btn-danger btn-xs remove-subcat" style="position: relative; left: 6px; top: 5px;">'+
                        '<span class="fa fa-minus"></span>'+
                        '</button>'+
                        '</div>';
                $(subCategory).insertBefore($(this).parent());
                var removesubcat = document.querySelectorAll('.remove-subcat');

                for (var i = 0; i < removesubcat.length; i++) {
                    removesubcat[i].addEventListener('click', function(){
                        $(this).parent().remove();
                    });
                }
            });

            $('.remove-subcat').click(function(e){
                e.preventDefault();
                var btn = $(this);
                var id = $(this).data('id');
                var href = $(this).data('href');
                $.ajax({
                    method: 'post',
                    data: {'id': id},
                    url: href,
                    success:function(data){
                        if(data == 1)
                            btn.parent().remove();
                        else
                            console.log('error');
                    }
                });

            });
        })();
    </script>

    <script>
        $(document).ready(function(){
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

                            var sub = files.length - img_valid_arr.length;

                            console.log(sub);

                            var selc_cont = (sub == 0) ? '<p>No image selected.</p>' : '<p>' + sub + ' image selected.</p>';

                            if (img_valid_arr.length > 0) {
                                imageBoxFooter.html(selc_cont + '<p style="color:red;">The image dimensions should be: 1600 width and 490 height</p>');

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
            $('.btn-slider-img-remove').click(function (e) {
                e.preventDefault();
                if (!confirm('Are you sure you want to delete this image?')) {
                    return false;
                }
                else {
                    var obj = $(this);
                    $.ajax({

                        method: 'post',
                        url: $(this).data('href'),
                        data: {image_id: $(this).data('image-id')},
                        success: function (data) {
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
        })
    </script>

@endsection