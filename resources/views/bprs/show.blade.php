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
                            <a href="{{ route('projects.show', $bpr->project_id) }}" class="btn btn-link ">Back to project</a>
                        </div>
                    </div>
                    {{ $bpr->mpr->project->name }} -
                    {{ $bpr->mpr->project->flavor }}
                </h1>
                <h2>
                    Lot: <strong>
                        {{substr($bpr->lot_number, 0, 4)}} -
                        {{substr($bpr->lot_number, 4, 2)}} -
                        {{substr($bpr->lot_number, 6, 3)}}
                    </strong>
                </h2>
                <p class="lead text-muted">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3> By: <strong> {{ $bpr->mpr->createdBy->name }}</strong></h3>
                        <h4> Batch size: <strong>{{ $bpr->bottle_count }} bottles</strong></h4>
                        <h4>Theoretical Yield: <strong> {{ $bpr->powders()->sum('amount') }} </strong></h4>
                    </div>

                    <div>
                        <h3>Mpr Version # <strong>{{$bpr->mpr->version}}</strong></h3>
                        <h4>Created <strong>{{ $bpr->created_at->diffForHumans() }}</strong></h4>
                        <h4>Grams Per Bottle: <strong>  {{ $bpr->mpr->gpb }} </strong></h4>
                    </div>
                </div>
                <p>
                @if($bpr->status == 'issued')
                    <h3>
                        Issued by <strong>{{ $bpr->createdBy->name }}</strong> {{$bpr->updated_at->diffForHumans()}}<br>
                        <a href="{{route('bpr.steps', $bpr->id)}}" class="btn btn-primary my-2 mr-2" >Manufacturing Instructions</a>
                    </h3>
                @elseif($bpr->status === 'rejected')
                    <h3>
                        Rejected by <strong>{{ $bpr->createdBy->name }}</strong> {{$bpr->updated_at->diffForHumans()}}
                    </h3>
                    <h4>
                        Reason: <strong>{{ $bpr->reason }}</strong>
                    </h4>
                @else
                    <button type="button" class="btn btn-primary my-2 mr-2" onclick="handleApprove()">Issue Batch</button>
                    <button type="button" class="btn btn-warning my-2" onclick="handleReject()">Reject Batch</button>
                @endif
                </p>
            </div>
        </section>


        <table class="table">
            <thead>
            <th>Name</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>UOM</th>
            </thead>
            <tbody>
            @foreach($bpr->products as $product)
                <tr>
                    <td>
                        {{$product->name}}
                    </td>

                    <td>
                        {{$product->category->name}}
                    </td>

                    <td>
                        {{$product->pivot->amount}}
                    </td>

                    <td>
                        @if($product->category->name == 'Powder')
                            g
                        @else
                            each
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>








    <form autocomplete="off" action="{{route('bprs.approve', $bpr->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">
                            {{ $bpr->mpr->project->name }} -
                            {{ $bpr->mpr->project->flavor }} : Issue Batch
                        </h5>
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

    <form autocomplete="new-password" action="{{route('bprs.reject', $bpr->id)}}" method="POST">
        @csrf
        @method('put')
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">
                            {{ $bpr->mpr->project->name }} -
                            {{ $bpr->mpr->project->flavor }} : Reject Batch
                        </h5>
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

                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <input type="text" class="form-control" name="reason">
                            </label>
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