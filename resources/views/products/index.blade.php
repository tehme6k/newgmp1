@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mb-2" type="button" onclick="handleAdd()">
                        Add product
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>All Products: <strong>{{$products->count()}}</strong></p>
            </div>
        </div>


        <div class="card card-default">
            <div class="card-header">
                All Products
            </div>
            <div class="card-body">
                @if($products->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Created By</th>

                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @if(auth()->user()->email == 'admin@admin.com')
                                        <a href="{{route('products.show', $product->id)}}" class="btn btn-link btn-md">
                                            {{$product->name}}
                                        </a>
                                    @else
                                        @can('read', $product)
                                            <a href="{{route('products.show', $product->id)}}" class="btn btn-link btn-md">
                                                {{$product->name}}
                                            </a>
                                        @else
                                            {{$product->name}}
                                        @endcan
                                    @endif
                                </td>

                                <td>
                                    {{ $product->category->name }}
                                </td>

                                <td>
                                    {{ $product->user->name }}
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No products at this time</h3>
                @endif
            </div>
        </div>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')

@endsection


