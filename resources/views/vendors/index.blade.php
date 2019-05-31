@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success mb-2" type="button" onclick="handleAdd()">
                        Add Vendor
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p>Total Vendors: <strong>{{$vendors->count()}}</strong></p>
            </div>
        </div>


        <div class="card card-default">
            <div class="card-header">
                All Vendors
            </div>
            <div class="card-body">
                @if($vendors->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Created By</th>

                        </thead>

                        <tbody>
                        @foreach($vendors as $vendor)
                            <tr>
                                <td>
                                    @if(auth()->user()->email == 'admin@admin.com')
                                        <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-link btn-md">
                                            {{$vendor->name}}
                                        </a>
                                    @else
                                        @can('read', $vendor)
                                            <a href="{{ route('vendors.show', $vendor->id) }}" class="btn btn-link btn-md">
                                                {{$vendor->name}}
                                            </a>
                                        @else
                                            {{$vendor->name}}
                                        @endcan
                                    @endif
                                </td>

                                <td>
                                    {{ $vendor->country->name }}
                                </td>

                                <td>
                                    {{ $vendor->user->name }}
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No vendors at this time</h3>
                @endif
            </div>
        </div>

        <form action="{{ route('vendors.store') }}" method="POST">
            @csrf
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add Vendor</h5>
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
                                <label for="category_id">Country</label>
                                <select name="country_id" id="category_id" class="form-control">
                                    <option value="">---</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Vendor</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
@endsection

@section('scripts')

@endsection


