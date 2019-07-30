{{--Add Bottle--}}

<form action="{{ route('mpr.add2') }}" method="POST">
    @csrf
    <div class="modal fade" id="addBottleModal" tabindex="-1" role="dialog" aria-labelledby="addBottleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBottleModalLabel">Add Bottle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                    <div class="form-group">
                        <label for="product_id">Select Bottle</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">---</option>
                            @foreach($bottlesAll as $bottle)
                                <option value="{{ $bottle->id }}">{{ $bottle->name }}</option>
                            @endforeach
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

{{--Add Lid--}}

<form action="{{ route('mpr.add2') }}" method="POST">
    @csrf
    <div class="modal fade" id="addLidModal" tabindex="-1" role="dialog" aria-labelledby="addLidModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLidModalLabel">Add Lid</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                    <div class="form-group">
                        <label for="product_id">Select Lid</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">---</option>
                            @foreach($lidsAll as $lid)
                                <option value="{{ $lid->id }}">{{ $lid->name }}</option>
                            @endforeach
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

{{--Add Scoop--}}

<form action="{{ route('mpr.add2') }}" method="POST">
    @csrf
    <div class="modal fade" id="addScoopModal" tabindex="-1" role="dialog" aria-labelledby="addScoopModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScoopModalLabel">Add Scoop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                    <div class="form-group">
                        <label for="product_id">Select Scoop</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">---</option>
                            @foreach($scoopsAll as $scoop)
                                <option value="{{ $scoop->id }}">{{ $scoop->name }}</option>
                            @endforeach
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

{{--Add Desiccant--}}

<form action="{{ route('mpr.add') }}" method="POST">
    @csrf
    <div class="modal fade" id="addDesiccantModal" tabindex="-1" role="dialog" aria-labelledby="addDesiccantModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDesiccantModalLabel">Add Desiccant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                    <div class="form-group">
                        <label for="product_id">Select Desiccant</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">---</option>
                            @foreach($desiccantsAll as $desiccant)
                                <option value="{{ $desiccant->id }}">{{ $desiccant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount">
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

{{--Add Powder--}}

<form action="{{ route('mpr.add') }}" method="POST">
    @csrf
    <div class="modal fade" id="addPowderModal" tabindex="-1" role="dialog" aria-labelledby="addPowderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPowderModalLabel">Add Powder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                    <div class="form-group">
                        <label for="product_id">Select Powder</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">---</option>
                            @foreach($powdersAll as $powder)
                                <option value="{{ $powder->id }}">{{ $powder->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount">
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