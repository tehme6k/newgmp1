@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                Full Inventory List
{{--                <div class="d-flex justify-content-end">--}}
{{--                    <div>--}}
{{--                        <button type="button" class="btn btn-success mb-2 mr-3" onclick="handleAdd()">Add</button>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <button type="button" class="btn btn-danger mb-2" onclick="handleAdd()">Remove</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        Total Adjustmets: <br>
                        Last Adjustment:
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>


        <div class="card card-default">

            <div class="card-body">
                @if($products->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Adjustments Count</th>
                        <th>Projects Used In</th>
                        <th>Total Inventory</th>
                        <th></th>
                        </thead>

                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <a href="{{route('products.show', $product->id)}}" class="btn btn-link btn-md">
                                        {{$product->name}}
                                    </a>

                                </td>

                                <td>
                                    {{$product->inventories->count()}}
                                </td>

                                <td>0</td>

                                <td>
                                    @if($product->inventories->sum('amount') > 0)
                                        @if($product->category->name === 'Powder')
                                            {{$product->inventories->sum('amount')}} Kg
                                        @else
                                            {{$product->inventories->sum('amount')}} each
                                        @endif
                                    @else
                                        <font color="red">
                                            @if($product->category->name === 'Powder')
                                                {{$product->inventories->sum('amount')}} Kg
                                            @else
                                                {{$product->inventories->sum('amount')}} each
                                            @endif
                                        </font>
                                    @endif
                                </td>

                                <td>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                @else
                    <h3 class="text-center">No inventory products at this time</h3>
                @endif
            </div>
        </div>
@endsection

@section('scripts')

@endsection


