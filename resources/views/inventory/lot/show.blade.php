@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="container">
            @include('partials.errors')
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">
                        <div class="d-flex justify-content-start">
                            {{--                            <div>--}}
                            {{--                                <a href="{{ route('products.show', $inventory->product->id) }}" class="btn btn-link">Back</a>--}}
                            {{--                            </div>--}}
                        </div>
                        {{$inventory->product->name}}
                    </h1>
                    <h2>
                        {{number_format($inventory->amount, 2)}}
                    </h2>
                    <p class="lead text-muted">
                    <h4>Status <strong>{{$inventory->status}}</strong></h4>
                    <h3>Created <strong>{{ $inventory->created_at->diffForHumans()}}</strong></h3>
                    <h3>By <strong>{{ $inventory->createdBy->name }}</strong></h3>
                    <p>
                    @if(auth()->user()->email == 'innovativetim06@gmail.com')
                        <div>
                            <a href="{{ route('lot.create', $inventory->id) }}" class="btn btn-info mb-2 mr-3">Make Adjustment</a>
                        </div>
                    @endif

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