@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="{{ route('vendors.index') }}" type="button" class="btn btn-primary mb-2 ">Back to all vendors</a>
                    </div>

                    <div>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <h2>
                    {{ $vendor->name }}
                </h2>
                <h4>
                    {{ $vendor->country->name }}
                </h4>
                <h5>
                    By <strong>{{ $vendor->user->name }}</strong> -
                    {{ $vendor->created_at->diffForHumans() }}
                </h5>
            </div>
        </div>


        <div class="card card-default mb-2">
            <div class="card-header">
                All Products using this vendor
            </div>
            <div class="card-body">

            </div>
        </div>

@endsection

