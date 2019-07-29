@extends('layouts.app')

@section('content')

    You do not have enough of the following products in inventory to issue this batch: <hr>

    @foreach($noInventory as $product)
        <li>{{$product}}</li>
    @endforeach
@endsection