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
                                        <button type="button" class="btn btn-success mr-5 " onclick="handleAddBottle()">Add Product</button>

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
            <div class="container">
                <div class="card-deck mb-3 text-canter">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Bottle</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title">
                                <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="handleAddBottle()">Add Bottle</button>
                            </h1>

                                @if($bottles->count() > 0)
                                <ul class="list-unstyled mt-3 mb4">
                                    @foreach($bottles as $bottle)
                                        <li>{{$bottle->amount}} - {{$bottle->product->name}}</li>
                                    @endforeach
                                </ul>
                                @else
                                @endif

                        </div>
                    </div>

                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Lid</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title">
                                <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="handleAddLid()">Add Lid</button>
                            </h1>
                            @if($lids->count() > 0)
                                <ul class="list-unstyled mt-3 mb4">
                                    @foreach($lids as $lid)
                                        <li>{{$lid->amount}} - {{$lid->product->name}}</li>
                                    @endforeach
                                </ul>
                            @else
                            @endif
                        </div>
                    </div>

                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Scoop</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title">
                                <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="handleAddScoop()">Add Scoop</button>
                            </h1>
                            @if($scoops->count() > 0)
                                <ul class="list-unstyled mt-3 mb4">
                                    @foreach($scoops as $scoop)
                                        <li>{{$scoop->amount}} - {{$scoop->product->name}}</li>
                                    @endforeach
                                </ul>
                            @else
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        <div class="container">
            <div class="card-deck mb-3 text-canter">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">(All)Active Powders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="handleAddPowder()">Add Powders</button>
                        </h1>
                        @if($powders->count() > 0)
                            <ul class="list-unstyled mt-3 mb4">
                                @foreach($powders as $powder)
                                    <li>{{$powder->amount}} - {{$powder->product->name}}</li>
                                @endforeach
                            </ul>
                        @else
                        @endif
                    </div>
                </div>

                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Inactive Powders</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary">Add inactive</button>
                        </h1>
                        <ul class="list-unstyled mt-3 mb4">
                            <li>Not</li>
                            <li>Working</li>
                            <li>yet</li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Desiccant</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">
                            <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="handleAddDesiccant()">Add Desiccant</button>
                        </h1>
                        @if($desiccants->count() > 0)
                            <ul class="list-unstyled mt-3 mb4">
                                @foreach($desiccants as $desiccant)
                                    <li>{{$desiccant->amount}} - {{$desiccant->product->name}}</li>
                                @endforeach
                            </ul>
                        @else
                        @endif
                    </div>
                </div>

            </div>
        </div>

        @else
                No Data
        @endif

</div>
@include('mprs._modals')

@endsection


@section('scripts')
        <script>
            function handleAddBottle() {
                console.log('Opening Modal from mpr.show.blade.php file scripts section')

                $('#addBottleModal').modal('show')
            }
            function handleAddLid() {
                console.log('Opening Modal from mpr.show.blade.php file scripts section')

                $('#addLidModal').modal('show')
            }
            function handleAddScoop() {
                console.log('Opening Modal from mpr.show.blade.php file scripts section')

                $('#addScoopModal').modal('show')
            }
            function handleAddDesiccant() {
                console.log('Opening Modal from mpr.show.blade.php file scripts section')

                $('#addDesiccantModal').modal('show')
            }
            function handleAddPowder() {
                console.log('Opening Modal from mpr.show.blade.php file scripts section')

                $('#addPowderModal').modal('show')
            }

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

