@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ $inventory->product->name }} : Adjustment
        </div>
        <div class="card-body">
            @include('partials.errors')


                <form action="{{ route('lot.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lot" id="lot" value="{{$inventory->vendor_lot}}">
                            <input type="hidden" name="category" id="category" value="{{$inventory->product->category->name}}">
                            <input type="hidden" name="vendor" id="vendor" value="{{$inventory->vendor_id}}">


                    <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" name="amount">
                            </div>

                            @if($inventory->product->category->name == 'Powder')
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="">Select</option>
                                        <option value="kg">Kilograms</option>
                                        <option value="g">Grams</option>
                                        <option value="lb">Pound</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="unit" id="unit" value="ea">
                            @endif


                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" id="notes" cols="30" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="expiration_date">Expiration date</label>
                                <input type="text" name="expiration_date" id="expiration_date" class="form-control">
                            </div>

                            {{--                Form End--}}

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        flatpickr('#expiration_date', {
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection