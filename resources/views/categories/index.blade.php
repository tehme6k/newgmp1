@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')
            <div class="card card-default mb-2">
                <div class="card-header">

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-success mb-2" onclick="handleAdd()">Add Category</button>
                    </div>

                </div>
            </div>

        <div class="card card-default">

            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        All Categories
                    </div>

                    <div>
                        Total: <strong>{{$categories->count()}}</strong>
                    </div>
                </div>

            </div>
            <div class="card-body">
                @if($categories->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Categories Count</th>
                        </thead>

                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <a href="{{route('inventories.category.index', $category->id)}}">{{$category->name}}</a>
                                </td>

                                <td>
                                    {{ $category->products->count() }}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h3 class="text-center">No categories at this time</h3>
                @endif
            </div>
        </div>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>


@endsection

@section('scripts')

@endsection