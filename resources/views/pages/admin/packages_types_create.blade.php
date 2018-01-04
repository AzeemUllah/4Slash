@extends('pages.admin.admin_template')


@section('header_title')

    <h1>Create a new Package Category</h1>

@endsection




@section('content')
    @if($update)
    <form method="post" action="{{  route('package.type.update') }}">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">

                    <div class="box-body">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Package Type Name</label>
                            <input name="package-name" value="{{ $update ? $package_type->name : '' }}" type="text" class="form-control" placeholder="Enter Package Type Name...">
                            <input name="type_id" value="{{ $update ? $package_type->id : '' }}" type="hidden" class="form-control" placeholder="Enter Package Type Name...">
                        </div>

                        <div class="text-center">
                            @if($update)
                            <button name="package-submit" type="submit" class="btn btn-primary btn-lg" type="submit">Update</button>
                             @else
                                <button name="package-submit" type="submit" class="btn btn-primary btn-lg" type="submit">Create</button>
                             @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>
        @else
            <form method="post" action="{{  route('adminpackagestypescreate') }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">

                            <div class="box-body">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Package Type Name</label>
                                    <input name="package-name"  type="text" class="form-control" placeholder="Enter Package Type Name...">
                                </div>

                                <div class="text-center">

                                        <button name="package-submit" type="submit" class="btn btn-primary btn-lg" type="submit">Create</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </form>
    @endif
@endsection
