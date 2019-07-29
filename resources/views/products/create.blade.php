@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Add new product
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

{{--                Form Start--}}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>


                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" name="location">
                </div>


                <div class="form-group">
                    <label for="par">Par</label>
                    <input type="number" step="any" class="form-control" name="par">
                </div>


                <div class="form-group">
                    <label for="cost">Cost</label>
                    <input type="number" step="any" class="form-control" name="cost">
                </div>


                <div class="form-group">
                    <label for="vendors">Vendors</label>
                    <select name="vendors[]" id="vendors" class="form-control vendors-selector" multiple>
                        @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}">
                                {{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

{{--                Form End--}}



                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.vendors-selector').select2();
        });
    </script>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endsection