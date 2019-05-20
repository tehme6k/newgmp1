@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="container">
            @include('partials.errors')
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">
                        <div class="d-flex justify-content-start">
                            <div>
                                <a href="{{ route('products.show', $inventory->product->id) }}" class="btn btn-link">Back</a>
                            </div>
                        </div>
                        {{$inventory->product->name}}
                    </h1>
                    <h2>
                        {{number_format($inventory->amount, 2)}} {{$unit}}
                    </h2>
                    <p class="lead text-muted">
                    <h4>Status <strong>{{$inventory->status}}</strong></h4>
                    <h3>Created <strong>{{ $inventory->created_at->diffForHumans()}}</strong></h3>
                    <h3>By <strong>{{ $inventory->createdBy->name }}</strong></h3>
                    <p>
                        @can('update inventory status')
                            @if($inventory->status != 'approved')
                                <button type="button" class="btn btn-success mb-2 " onclick="handleApprove()">Approve</button>
                            @endif

                            @if($inventory->status != 'rejected')
                                <button type="button" class="btn btn-danger mb-2 ml-2" onclick="handleReject()">Reject</button>
                            @endif
                        @endcan

                        @can('upload inventory file')
                            <button class="btn btn-info mb-2 ml-2" onclick="handleNewFile()">Add File</button>
                        @endcan
                    </p>
                </div>
            </section>


            <table class="table">
                <thead>
                @yield('table-header')
                </thead>
                <tbody>
                @yield('table-body')
                </tbody>
            </table>



    {{--list each file--}}
    @if($inventory->files->count() > 0)
        <div class="list-group">
            @foreach($inventory->files as $file)
                    <li class="list-group-item">
                        <a href="{{ asset('/storage/'. $file->name) }}">{{$file->name}} - ({{ $file->created_at }})</a>
                    </li>
            @endforeach
        </div>
    @endif

    {{--modals begin--}}
    <form action="{{route('inventories.newFile', $inventory->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal fade" id="newFileModal" tabindex="-1" role="dialog" aria-labelledby="newFileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newFileModalLabel">{{$inventory->product->name}} : Add File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="category" value="{{$inventory->product->category->name}}">

                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file" class="form-control">
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

    <form autocomplete="off" action="{{route('inventories.approve', $inventory->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">{{$inventory->product->name}} : Approve</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="category" value="{{$inventory->product->category->name}}">

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password">
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

    <form autocomplete="new-password" action="{{route('inventories.reject', $inventory->id)}}" method="POST">
        @csrf
        @method('put')
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">{{$inventory->product->name}} : Reject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password">
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
        function handleNewFile() {
            console.log('Opening Modal from inventories.show.blade.php file scripts section')

            $('#newFileModal').modal('show')
        }

        function handleApprove() {
            console.log('Opening Modal from inventories.show.blade.php file scripts section')

            $('#approveModal').modal('show')
        }

        function handleReject() {
            console.log('Opening Modal from inventories.show.blade.php file scripts section')

            $('#rejectModal').modal('show')
        }
    </script>
@endsection