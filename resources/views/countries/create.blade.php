@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Add new Country
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ route('countries.store') }}" method="POST" >
                @csrf

                {{--                Form Start--}}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="abr">Abbreviation</label>
                    <input type="text" name="abr" id="abr" class="form-control">
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

@endsection

@section('css')

@endsection