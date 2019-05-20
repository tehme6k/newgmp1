@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">
                    {{$user->name}}
                </h1>
                <h2>
                    {{ $user->role }}
                </h2>
                <p class="lead text-muted">
                <h3> Email: <strong> {{ $user->email }}</strong></h3>
                <h4>{{$user->created_at->diffForHumans()}}</h4>
                <p>
                <div>
                    @if($user->email != 'innovativetim06@gmail.com')
                        <button type="button" class="btn btn-success mb-2 " onclick="handleEdit()">Edit</button>
                    @endif
                </div>
                </p>
            </div>
        </section>


        <table class="table">
            <thead>
            <th>Task</th>
            <th>Completed</th>
            <th>By User</th>
            <th>Added Later</th>
            </thead>
            <tbody>
            <tr>
                <td colspan="4">
                    Nothing to show.
                </td>
            </tr>
            </tbody>
        </table>



        @yield('content')
    </div>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">{{$user->name}} : Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <select name="role" id="role" class="form-control">
                                <option value="">---</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection


@section('scripts')
    <script>
        function handleEdit() {
            console.log('Opening Modal from users.show.blade.php file scripts section')

            $('#editModal').modal('show')
        }
    </script>
@endsection