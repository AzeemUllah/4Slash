@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Create a new Gig Category</h1>

@endsection




@section('content')

    <form method="post" action="@if($update){{ route('gigs.categories.update') }}@else{{ route('admingigscategoriescreatecreate') }}@endif">
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

                        <label>Sub Categories</label>
                        <div class="row">
                            @if($update)
                                @foreach(\App\Gigtype_Subcategory::where(['gigtypes_id' => $category->id])->get() as $subcat)
                                    <div class="col-md-2 form-group">
                                            <input value="{{ $subcat->name }}" name="subcategories[]" type="text" class="form-control" placeholder="Enter Subcategory Name...">
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-2 form-group">
                                    <input name="subcategories[]" type="text" class="form-control" placeholder="Enter Subcategory Name...">
                                </div>
                            @endif
                            <div class="col-md-2 form-group">
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
                var subCategory = '<div class="col-md-2 form-group"><input name="subcategories " type="text" class="form-control" placeholder="Enter Subcategory Name..."></div>';
                $(subCategory).insertBefore($(this).parent());
            });
        })();
    </script>


@endsection
