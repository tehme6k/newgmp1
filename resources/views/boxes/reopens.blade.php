@extends('layouts.app')

@section('jumbotron-header')
    <div class="d-flex justify-content-start">
        <div>
            <a href="{{ route('boxes.index') }}" class="btn btn-link">View All Open Boxes</a>
        </div>
    </div>

    Retention Box # <strong>{{$box->id}}</strong>
@endsection


@section('jumbotron-under-header')
     <strong>{{ $box->status }} -
    {{$retentions->count()}}</strong> total products</h3>
@endsection


@section('jumbotron-content')
    <h3>Requested By: <strong>{{$reopendata->requestedBy->name}}</strong><br></h3>
    <h3>On: <strong>{{\Carbon\Carbon::parse($reopendata->reopen_date)->format('d M Y')}}</strong><br></h3>
    <h3>Reason: <strong>{{$reopendata->reason}}</strong></h3>
@endsection


@section('jumbotron-buttons')
    <button type="button" class="btn btn-outline-danger" onclick="handleClose()">
        Close this box
    </button>
@endsection


@section('table-header')
    <th>Lot #</th>
    <th>Name</th>
    <th>Production</th>
    <th>Expiration</th>
    <th>Added By</th>
@endsection


@section('table-body')
    @foreach($retentions as $retention)
        <tr>
            <td>
                {{substr($retention->lot_number, 0, 4)}} -
                {{substr($retention->lot_number, 4, 2)}} -
                {{substr($retention->lot_number, 6, 3)}}
            </td>

            <td>
                {{$retention->project->name}} -
                {{$retention->project->flavor}}
            </td>

            <td>
                {{\Carbon\Carbon::parse($retention->production_date)->format('d M Y')}}
            </td>

            <td>
                {{\Carbon\Carbon::parse($retention->expiration_date)->format('d M Y')}}
            </td>

            <td>
                {{ $retention->user->name }}
            </td>
        </tr>
    @endforeach
@endsection


@section('content')
    <form action="{{ route('reopen.close', [$box->id, $reopendata->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="closeModalLabel">Close Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="close_date" value="{{ $reopendata->reopen_date }}">
                        <input type="hidden" name="closed_by" value="{{ auth()->user()->id }}">

                        Click 'Close Box' below if you are sure you wish to close this box and store it.

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Close Box</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>




        function handleClose() {
            console.log('Opening Modal from reopens.blade.php script section')

            $('#closeModal').modal('show')
        }

        flatpickr('#production_date', {
        })

    </script>
@endsection