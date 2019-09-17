@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Add new project type
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{ route('types.store') }}" method="POST" >
                @csrf

                {{--                Form Start--}}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
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