@extends('layouts.app')

@section('content')


<div class="container">
        @include('partials.errors')
        <section class="jumbotron text-center">
                <div class="container">
                        <h1 class="jumbotron-heading">
                                <div class="d-flex justify-content-start">
                                        <div>
                                                <a href="{{ route('projects.show', $mpr->project->id) }}" class="btn btn-link ">Back to project</a>
                                        </div>
                                </div>
                                {{ $mpr->project->name }} -
                                {{ $mpr->project->flavor }}
                        </h1>
                        <h2>
                                MPR Version # <strong>{{$mpr->version}}</strong>
                        </h2>
                        <p class="lead text-muted">
                                By <strong> {{ $mpr->createdBy->name }}</strong> -
                        {{ $mpr->created_at->diffForHumans() }}
                        <p>
                        <div>
                                @if($mpr->status == 'approved')
                                        <button type="button" class="btn btn-success mb-2 " onclick="handleNewBPR()">Create BPR</button>
                                @else
                                        <button type="button" class="btn btn-success mr-5 " onclick="handleAdd()">Add Product</button>

                                        <button type="button" class="btn btn-outline-primary ml-5" onclick="handleApprove()">Approve</button>
                                @endif
                        </div>

                        <div class="text-center">
                                @if($bprs->count() > 0)
                                        <ul class="list-group" style="display: inline-block;">
                                                @foreach($bprs as $bpr)
                                                        <li class="list-group-item py-1 w-100">
                                                                <a href="{{route('bprs.show', $bpr->id)}}">
                                                                        {{substr($bpr->lot_number, 0, 4)}} -
                                                                        {{substr($bpr->lot_number, 4, 2)}} -
                                                                        {{substr($bpr->lot_number, 6, 3)}}
                                                                </a>
                                                        </li>
                                                @endforeach
                                        </ul>
                                @endif
                        </div>
                        </p>
                </div>
        </section>

        @if($mpr->products->count() > 0)

{{--          Powder Table      --}}
       <button>Add Powder</button>
       @if($powders->count() > 0)
                        <table class="table table-responsive table-hover">
                                <thead class="thead-dark">
                                <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>UOM</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-1" aria-expanded="false" aria-controls="group-of-rows-1">
                                        <td>Click to Open/Close</td>
                                        <td></td>
                                        <td></td>

                                </tr>
                                </tbody>

                                <tbody id="group-of-rows-1" class="collapse">
                                @foreach($powders as $powder)
                                        <tr>
                                                <td>{{$powder->product->name}}</td>
                                                <td>{{$powder->amount}}</td>
                                                <td>MG</td>
                                        </tr>
                                @endforeach
                                </tbody>
                        </table>
       @endif

        {{--          Bottle Table      --}}
        <button>Add Bottle</button>
        @if($bottles->count() > 0)
                        <table class="table table-responsive table-hover">
                                <thead class="thead-dark">
                                <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>UOM</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-2" aria-expanded="false" aria-controls="group-of-rows-1">
                                        <td>Click to Open/Close</td>
                                        <td></td>
                                        <td></td>

                                </tr>
                                </tbody>

                                <tbody id="group-of-rows-2" class="collapse">
                                @foreach($bottles as $bottle)
                                        <tr>
                                                <td>{{$bottle->product->name}}</td>
                                                <td>{{$bottle->amount}}</td>
                                                <td>Ea</td>
                                        </tr>
                                @endforeach
                                </tbody>
                        </table>
        @endif

        {{--          Lids Table      --}}
        <button>Add Lid</button>
        @if($lids->count() > 0)
                        <table class="table table-responsive table-hover">
                                <thead class="thead-dark">
                                <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>UOM</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-3" aria-expanded="false" aria-controls="group-of-rows-1">
                                        <td>Click to Open/Close</td>
                                        <td></td>
                                        <td></td>

                                </tr>
                                </tbody>

                                <tbody id="group-of-rows-3" class="collapse">
                                @foreach($lids as $lid)
                                        <tr>
                                                <td>{{$lid->product->name}}</td>
                                                <td>{{$lid->amount}}</td>
                                                <td>Ea</td>
                                        </tr>
                                @endforeach
                                </tbody>
                        </table>
        @endif

        {{--          Scoops Table      --}}
        <button>Add Scoop</button>
        @if($scoops->count() > 0)
                        <table class="table table-responsive table-hover">
                                <thead class="thead-dark">
                                <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>UOM</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-4" aria-expanded="false" aria-controls="group-of-rows-1">
                                        <td>Click to Open/Close</td>
                                        <td></td>
                                        <td></td>

                                </tr>
                                </tbody>

                                <tbody id="group-of-rows-4" class="collapse">
                                @foreach($scoops as $scoop)
                                        <tr>
                                                <td>{{$scoop->product->name}}</td>
                                                <td>{{$lid->amount}}</td>
                                                <td>Ea</td>
                                        </tr>
                                @endforeach
                                </tbody>
                        </table>
        @endif

        {{--          Desiccant Table      --}}
        <button>Add Desiccant</button>
        @if($desiccants->count() > 0)
                        <table class="table table-responsive table-hover">
                                <thead class="thead-dark">
                                <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>UOM</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-5" aria-expanded="false" aria-controls="group-of-rows-1">
                                        <td>Click to Open/Close</td>
                                        <td></td>
                                        <td></td>

                                </tr>
                                </tbody>

                                <tbody id="group-of-rows-5" class="collapse">
                                @foreach($desiccants as $desiccant)
                                        <tr>
                                                <td>{{$desiccant->product->name}}</td>
                                                <td>{{$desiccant->amount}}</td>
                                                <td>Ea</td>
                                        </tr>
                                @endforeach
                                </tbody>
                        </table>
        @endif



        @else
                No Data
        @endif




        @yield('content')
</div>

        <form action="{{ route('mpr.add') }}" method="POST">
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

                                                <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                                                <div class="form-group">
                                                        <label for="product_id">Select Product</label>
                                                        <select class="form-control" name="product_id" id="product_id">
                                                                <option value="">---</option>
                                                                @foreach($allProducts as $allProduct)
                                                                        <option value="{{ $allProduct->id }}">{{ $allProduct->name }}</option>
                                                                @endforeach
                                                        </select>
                                                </div>

                                                <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" step="any" class="form-control" name="amount" id="amount">
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


        <form action="{{ route('bprs.store') }}" method="POST">
                @csrf
                <div class="modal fade" id="newBprModal" tabindex="-1" role="dialog" aria-labelledby="newBprModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="newBprModalLabel">New BPR</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">

                                                <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">
                                                <input type="hidden" name="serving_size" value="{{ $mpr->serving_size }}">
                                                <input type="hidden" name="project_id" value="{{ $mpr->project->id }}">
                                                <input type="hidden" name="run_count" value="{{ $mpr->project->batch_count }}">




                                                <div class="form-group">
                                                        <label for="bottle_count">Bottle Count</label>
                                                        <input type="number" class="form-control" name="bottle_count" id="bottle_count">
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


        <form autocomplete="off" action="{{route('mprs.approve', $mpr->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">{{$mpr->project->name}} - {{ $mpr->project->flavor }} : Approve</h5>
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
                function handleNewBPR() {
                        console.log('Opening Modal from mpr.show.blade.php file scripts section')

                        $('#newBprModal').modal('show')
                }

                function handleApprove() {
                        console.log('Opening Modal from mpr.show.blade.php file scripts section')

                        $('#approveModal').modal('show')
                }
        </script>
@endsection

