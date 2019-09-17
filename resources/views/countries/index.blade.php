@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')


            <div class="card card-default mb-2">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('countries.create') }}" class="btn btn-success mb-2">
                            Add country
                        </a>
                    </div>
                </div>
            </div>



        <div class="card card-default">

            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        Total Countries
                    </div>

                    <div>
                        Total: <strong>{{$countries->count()}}</strong>
                    </div>
                </div>

            </div>
            <div class="card-body">
                @if($countries->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Abr</th>
                        </thead>

                        <tbody>
                        @foreach($countries as $country)
                            <tr>
                                <td>
                                    <a href="{{route('countries.show', $country->id)}}">{{$country->name}}</a>
                                </td>

                                <td>
                                    {{ $country->abr }}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No countries at this time</h3>
                @endif
            </div>
        </div>




@endsection

@section('scripts')

@endsection