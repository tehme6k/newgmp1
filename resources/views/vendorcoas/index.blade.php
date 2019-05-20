@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success mb-2" onclick="handleAdd()">Upload Vendor COA</button>
                </div>
            </div>
            <div class="card-body">
                <p>Vendor COAs: <strong>{{$vendorcoas->count() > 0 ? $vendorcoas->count() : '0'}}</strong></p>
            </div>
        </div>


        <div class="card card-default">
            <div class="card-header">
                All Categories
            </div>
            <div class="card-body">
                @if($vendorcoas->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Lot</th>
                        <th>Uploaded By</th>
                        <th>File</th>
                        </thead>

                        <tbody>
                        @foreach($vendorcoas as $coa)
                            <ul>
                                @foreach($coa->files as $file)
                                    <li>
                                        {{$file->name}}
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No Vendor COA's at this time</h3>
                @endif
            </div>
        </div>

    <form action="{{ route('vendorcoas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add New Vendor COA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="">---</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lot">Lot</label>
                            <input type="text" name="lot" class="form-control py-3">
                        </div>

                        <div class="form-group d-flex flex-column">
                            <label for="file">Select File</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Coa</button>
                    </div>
                </div>
            </div>
        </div>

    </form>


@endsection

@section('scripts')

@endsection