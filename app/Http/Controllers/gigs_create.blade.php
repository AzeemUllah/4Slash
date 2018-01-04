@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Create a new Gig</h1>

@endsection




@section('content')

    @if(!$update)
        <form method="post" enctype="multipart/form-data">
    @else
        <form action="{{ route('gig.update') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gig-id" value="{{ $gig->id }}">
    @endif

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Title</label>
                            <input value="{{ ($update) ? $gig->title : '' }}" name="gig-title" type="text"
                                   class="form-control" placeholder="Enter Gig Title...">
                        </div>


                        <div class="form-group">
                            <label>Short Discription</label>
                            <input value="{{ ($update) ? $gig->short_discription : '' }}" name="gig-short-discription"
                                   type="text" class="form-control" placeholder="Enter Gig Short Discription...">
                        </div>


                        <!-- textarea -->
                        <div class="form-group">
                            <label>Discription</label>
                            <textarea id="gigDiscription" name="gig-discription" class="form-control" rows="3"
                                      placeholder="Enter Gig Discription...">{{ ($update) ? $gig->discription : '' }}</textarea>
                        </div>


                        <!-- select -->
                        <div class="form-group">
                            <label>Category</label>
                            <select id="categorySelectList" name="gig-category" class="form-control" data-url="{{ route('admin.category.subcategories') }}">
                                @foreach($categories as $category)
                                    <option {{ (($update) ? (($category->id == $gig->gigtype_id) ? 'selected' : '') : '') }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- select -->
                       <!--   <div class="form-group">
                            <label>Sub Category</label>
                            <select id="subCategorySelectList" name="gig-sub-category" class="form-control">
                                @foreach($subCategories as $subCat)
                                    <option {{ (($update) ? (($subCat->id == $gig->gigtypes_subcategories_id) ? 'selected' : '') : '') }} value="{{ $subCat->id }}">{{  $subCat->name }}</option>
                                @endforeach
                                {{--@foreach($categories as $category)--}}
                                    {{--<option {{ (($update) ? (($category->id == $gig->gigtype_id) ? 'selected' : '') : '') }} value="{{ $category->id }}">{{ $category->name }}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div> -->


                        <!-- select -->
                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label>Delivery Days</label>
                                <select name="gig-delivery-days" class="form-control">
                                    @for($i = 1; $i <= 30; $i++)
                                        <option {{ (($update) ? (($gig->delivery_days == $i) ? 'selected' : '') : '') }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>


                            <div class="col-md-6 form-group">
                                <label>Price</label>

                                <div class="input-group">
                                    <span class="input-group-addon">&euro;</span>
                                    <input value="{{ (($update) ? $gig->price : '') }}" name="gig-price" type="number"
                                           class="form-control">
                                    <span class="input-group-addon">.00</span>
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
                        <h3 class="box-title">Images</h3>
                        <input style="position:absolute;top:0px;left:0px;width:0.1px;height:0.1px;opacity:0;overflow:hidden;" name="gig-images[]" accept="image/*" type="file" multiple id="fileee">
                        <label class="btn btn-primary btn-xs pull-right" for="fileee"><span class="fa fa-plus"></span></label>
                    </div>
                    <div class="box-body gig-images-box-body">
                        @if($update)
                            @foreach($gigImages as $gigImage)
                                <div style="position:relative;display:inline-block;">
                                    <input id="gigImageId" type="hidden" name="gig-image-id" value="{{  $gigImage->id }}">
                                    <a href="{{ route('gig.image.remove', [$gigImage->id]) }}" style="position:absolute;right:0px;top:0px;padding:0px 6px;" class="btn btn-default btn-gig-img-remove">x</a>
                                    <img style="height:60px;" src="{{ url('/files/gigs/images') . '/' . $gigImage->image }}">
                                </div>
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
                        <button type="button" id="add-new-addon" class="btn btn-primary btn-xs pull-right"><span
                                    class="fa fa-plus"></span></button>
                    </div>
                    <div class="box-body">
                        @if($update)
                            <?php $i = 1; ?>
                            @foreach($gigAddons as $gigAddon)
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <input value="{{ $gigAddon->addon }}"
                                                   name="gig-addon[{{ $i }}][discription]" type="text"
                                                   class="form-control" placeholder="Enter Addon Discription...">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">&euro;</span>
                                                <input value="{{ $gigAddon->amount }}" name="gig-addon[{{ $i }}][price]"
                                                       type="number" class="form-control">
                                                <span class="input-group-addon">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 del-btn-box">
                                        <button type="button" class="btn btn-danger btn-xs remove-addon"><span
                                                    class="fa fa-minus"></span></button>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endforeach
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
                            <button type="button" id="add-choice-question" class="btn btn-primary btn-xs"><span
                                        class="fa fa-plus"></span> Add Choice Question
                            </button>
                            <button disabled type="button" id="add-range-question" class="btn btn-primary btn-xs"><span
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
                                        <button type="button" class="btn btn-danger btn-xs remove-choice-question"><span
                                                    class="fa fa-minus"></span></button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Choice Question</label>
                                                <input value="{{ $gigQuestion->question }}"
                                                       name="gig-choice-question[{{ $i }}][question]" type="text"
                                                       class="form-control" placeholder="Enter ...">
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
                                                            <input value="{{ $answer }}" class="answer" name="gig-choice-question[{{ $i }}][answers][]" style="width:100%" type="text">
                                                        </div>
                                                    @endforeach
                                                    <div class="col-md-2">
                                                        <button type="button" style="width:100%;" class="btn btn-primary">Add more choices</button>
                                                    </div>
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
                <button class="btn btn-primary btn-lg" type="submit">Update</button>
            @else
                <button class="btn btn-primary btn-lg" type="submit">Create</button>
            @endif
        </div>
    </form>

@endsection



@section('pages_css')

    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/select2/select2.min.css') }}">

@endsection



@section('pages_script')

    <script src="{{ asset('bower_components/AdminLTE/plugins/select2/select2.full.min.js') }}"></script>

    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>

    <script>
        tinymce.init({
            selector: '#gigDiscription'
        });
    </script>

    <script>

        (function () {
            $('#categorySelectList').change(function(e) {

                var cat = $(this);
                var catId = cat.val();

                $.ajax({
                    url: cat.data('url') + '?cat-id=' + catId,
                    method: 'get',
                    success: function(data){
                        var cats = '';
                        data.forEach(function(element, index, array) {
                            cats += '<option value="' + element.id + '">'+ element.name +'</option>';
                        });

                        $('#subCategorySelectList').html(cats);
                    }
                });

            });
            document.querySelector('#fileee').addEventListener('change', function() {
                var files = this.files;
                var imageBox = document.querySelector('.gig-images-box .box-body');
                var imageBoxFooter = document.querySelector('.gig-images-box .box-footer');

                if(files.length > 0) {
                    for(var i = 0; i < files.length; i++) {
                        var imgElement = document.createElement('img');
                        imgElement.src = window.URL.createObjectURL(files[i]);
                        imgElement.className = 'meriimage';
                        imgElement.height = 60;
                        imgElement.onload = function() {
                            window.URL.revokeObjectURL(imgElement.src);
                        }
                        imageBox.appendChild(imgElement);
                    }
                    imageBoxFooter.innerHTML = '';
                    imageBoxFooter.innerHTML = '<p>'+ files.length +' image selected.</p>';

                } else {
                    imageBox.innerHTML = '';
                    imageBoxFooter.innerHTML = '<p>No image selected.</p>';
                }
            });
            document.querySelector('#add-new-addon').addEventListener('click', addAddon);
            document.querySelector('#add-choice-question').addEventListener('click', addChoiceQuestion);
            document.querySelector('#add-range-question').addEventListener('click', addRangeQuestion);
            document.querySelector('.gig-images-box-body').addEventListener('click', function(e) {
                e.preventDefault();
                var clickedElement = e.srcElement;
                if(clickedElement.nodeName == 'A') {
                    $.ajax({
                        url: clickedElement.href,
                        method: 'post',
                        data: { 'gig-image-id': $(clickedElement).parent().find('#gigImageId').val() },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            })



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

        function addAddon() {


            console.log(changeName(this));


            var newAddon = $('<div class="row">' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<input name="' + changeName(this) + '" type="text" class="form-control" placeholder="Enter Addon Discription...">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                    '<div class="form-group">' +
                    '<div class="input-group">' +
                    '<span class="input-group-addon">&euro;</span>' +
                    '<input name="' + changeName2(this) + '" type="number" class="form-control">' +
                    '<span class="input-group-addon">.00</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2 del-btn-box">' +
                    '<button type="button" class="btn btn-danger btn-xs remove-addon"><span class="fa fa-minus"></span></button>' +
                    '</div>' +
                    '</div>');


            $('.addons-box .box-body').append(newAddon);


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
                            '<input class="answer" name="'+ choiceQuestionChangeName3(this) +'[]" style="width:100%" type="text">' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<input class="answer" name="'+ choiceQuestionChangeName3(this) +'[]" style="width:100%" type="text">' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<button type="button" style="width:100%;" class="btn btn-primary">Add more choices</button>' +
                        '</div>' +
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

@endsection