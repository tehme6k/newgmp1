@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('products.create') }}" class="btn btn-success mb-2">
                        Add product
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p>Total {{$category->name}}: <strong>{{$products->count()}}</strong></p>
            </div>
        </div>


        <div class="card card-default">
            <div class="card-header">
                All {{$category->name}}
            </div>
            <div class="card-body">
                @if($products->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Total</th>
                        <th>Par</th>
                        <th>Category</th>
                        {{--                        <th>Created By</th>--}}
                        <th>Cost Per Kilo</th>
                        <th>Total Cost</th>
                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            @if($product->total < $product->par)
                                <tr class="table-danger">
                            @else
                                <tr>
                                    @endif
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
                                        {{number_format($product->total, 2)}}
                                    </td>

                                    <td>

                                        {{number_format($product->par, 2)}}

                                    </td>

                                    <td>
                                        {{ $product->category->name }}
                                    </td>

                                    {{--                                <td>--}}
                                    {{--                                    {{ $product->user->name }}--}}
                                    {{--                                </td>--}}

                                    <td>
                                        ${{number_format($product->cost, 2)}}

                                    </td>

                                    <td>

                                        ${{number_format($product->total * $product->cost, 2)}}
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


@endsection
