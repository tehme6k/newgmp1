@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')

        <div class="card card-default mb-2">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    @can('add_projects')
                        <button class="btn btn-success mb-2" type="button" onclick="handleAdd()">
                            Add Project
                        </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <p>Projects: <strong>{{$projects->count()}}</strong></p>
            </div>
        </div>


        <div class="card card-default">
            <div class="card-header">
                All Projects
            </div>
            <div class="card-body">
                @if($projects->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Flavor</th>
                        <th>Type</th>
                        <th>Country</th>
                        <th>Mpr Versions</th>

                        </thead>

                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>
                                    @if(auth()->user()->email == 'admin@admin.com')
                                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-link btn-md">
                                            {{$project->name}}
                                        </a>
                                    @else
                                        @can('read', $project)
                                            <a href="{{ route('projects.show', $project->id) }}" class="btn btn-link btn-md">
                                                {{$project->name}}
                                            </a>
                                        @else
                                            {{$project->name}}
                                        @endcan
                                    @endif
                                </td>

                                <td>
                                    {{ $project->flavor }}
                                </td>

                                <td>
                                    {{ $project->type->name }}
                                </td>

                                <td>
                                    {{ $project->country->name }}
                                </td>

                                <td>
                                    0
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$projects->links()}}
                @else
                    <h3 class="text-center">No products at this time</h3>
                @endif
            </div>
        </div>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Product</h5>
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
                            <label for="flavor">Flavor</label>
                            <input type="text" name="flavor" id="flavor" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                <option value="">---</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Type</label>
                            <select name="type_id" id="type_id" class="form-control">
                                <option value="">---</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')

@endsection

