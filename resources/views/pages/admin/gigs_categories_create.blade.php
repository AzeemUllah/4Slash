@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Create a new Favor Category</h1>

@endsection




@section('content')

    <form method="post" action="@if($update){{ route('gigs.categories.update') }}@else{{ route('admingigscategoriescreatecreate') }}@endif" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Category Name</label>
                            @if($update)
                                <input name="category-id" type="hidden" value="{{ $category->id }}">
                            @endif
                            @if($update)
                                <input value="{{ $category->name }}" name="category-name" type="text" class="form-control" placeholder="Enter Category Name...">
                            @else
                                <input name="gigcategory-name" type="text" class="form-control" placeholder="Enter Category Name...">
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-info gig-images-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Images</h3>
                                        <input style="position:absolute;top:0px;left:0px;width:0.1px;height:0.1px;opacity:0;overflow:hidden;" name="gig-image" type="file" id="fileee">
                                        <label class="btn btn-primary btn-xs pull-right" for="fileee"><span class="fa fa-plus"></span></label>
                                    </div>
                                    <div class="box-body gig-images-box-body">
                                        @if(!empty($category->image))
                                            <img src="{{ url('/files/gigs/images') . '/' . $category->image }}" class="meriimage" style="height:60px">
                                        @endif
                                    </div>
                                    <div class="box-footer"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Category Description</label>
                            <input name="gigcategory-description" value="{{ $update ? $category->description : ''}}" type="text" class="form-control" placeholder="Enter Category description...">
                        </div>

                        <label>Sub Categories</label>
                        <div class="row">
                            @if($update)
                                <?php $i = 0; ?>
                                @foreach(\App\Gigtype_Subcategory::where(['gigtypes_id' => $category->id])->get() as $subcat)
                                    <div class="col-md-2 form-group">
                                            <input value="{{ $subcat->name }}" name="subcategories[]" type="text" class="form-control" placeholder="Enter Subcategory Name..." style="float: left; width: 224px;position: relative;">
                                            <input value="{{ $subcat->id }}" name="subcategoriesid{{$i}}" type="hidden" class="form-control" placeholder="Enter Subcategory Name...">
                                            <button data-href="{{ route('gig-subcat-remove') }}" type="button"
                                                    data-id="{{ $subcat->id }}"
                                                    class="btn btn-danger btn-xs remove-subcat" style="position: relative; left: 6px; top: 5px;">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                    </div>
                                    <?php $i++ ;?>
                                @endforeach
                            @else
                                <div class="col-md-2 form-group">
                                    <input name="subcategories[]" type="text" class="form-control" placeholder="Enter Subcategory Name...">
                                </div>
                            @endif
                            <div class="col-md-2 form-group subcat">
                                <input id="btnAddMoreSubcategory" type="button" class="form-control btn btn-primary" value="Add New Subcategory">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg" type="submit">
                                @if($update)
                                    Update
                                @else
                                    Create
                                @endif
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>




    </form>

@endsection




@section('pages_script')

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
            document.querySelector('#fileee').addEventListener('change', function() {
                var files = this.files;
                var imageBox = document.querySelector('.gig-images-box .box-body');
                var imageBoxFooter = document.querySelector('.gig-images-box .box-footer');

                if(files.length > 0) {
                        var imgElement = document.createElement('img');
                        imgElement.src = window.URL.createObjectURL(files[0]);

                        imgElement.className = 'meriimage';
                        imgElement.height = 60;
                        imgElement.onload = function() {
                            window.URL.revokeObjectURL(imgElement.src);
                        }
                    imageBox.innerHTML = '';
                    imageBox.appendChild(imgElement);
                    imageBoxFooter.innerHTML = '';
                    imageBoxFooter.innerHTML = '<p>'+ files.length +' image selected.</p>';

                } else {
                    imageBox.innerHTML = '';
                    imageBoxFooter.innerHTML = '<p>No image selected.</p>';
                }
            });
        })
    </script>

@endsection
