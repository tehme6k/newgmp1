@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('types.create') }}" class="btn btn-success mb-2">
                        Add project type
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p>Total Project Types: <strong>{{$types->count()}}</strong></p>
            </div>
        </div>


        <div class="card card-default">
            <div class="card-header">
                All Project Types
            </div>
            <div class="card-body">
                @if($types->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        </thead>

                        <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <td>
                                        <a href="{{route('types.show', $type->id)}}" class="btn btn-link btn-md">
                                            {{$type->name}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No project types at this time</h3>
                @endif
            </div>
        </div>


@endsection


