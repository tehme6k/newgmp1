<?php $inventory = App\Inventory::first(); ?>
@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.errors')
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">
                    {{$product->name}}
                </h1>
                <h2>
                    {{ $product->category->name }}
                </h2>
                <p class="lead text-muted">
                <h3> By: <strong> {{ $product->user->name }}</strong></h3>
                @if(isset($total))
                    <h4>Total: {{number_format($total->sum('amount'), 2)}} {{$unit}}</h4>
                @else
                    <h4>Total: 0</h4>
                @endif
                <p>
                    @if(auth()->user()->email == 'admin@admin.com')
                        <div>
                            <button type="button" class="btn btn-info mb-2 mr-3" onclick="handleReceive()">Recieve In</button>
                            <button type="button" class="btn btn-success mb-2 ml-3" onclick="handleAdjustment()">Make Adjustment</button>
                        </div>
                    @else
                        @can('edit', $inventory)
                            <div>
                                <button type="button" class="btn btn-info mb-2 mr-3" onclick="handleReceive()">Recieve In</button>
                                <button type="button" class="btn btn-success mb-2 ml-3" onclick="handleAdjustment()">Make Adjustment</button>
                            </div>
                        @endcan
                    @endif
                </p>
            </div>
        </section>

        @if($inventories->count() > 0)
        <table class="table">
            <thead>
            <th>Amount</th>
            <th>Added By</th>
            <th>Added On</th>
            <th>Status</th>
            <th>Files</th>
            </thead>
            <tbody>
            @foreach($inventories as $inventory)
                <tr>
                    <td>
                        @can('read', $inventory)
                            <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-link">
                                {{number_format($inventory->amount, 2)}} {{$unit}}
                            </a>
                        @else
                            {{number_format($inventory->amount, 2)}} {{$unit}}
                        @endcan
                    </td>

                    <td>
                        {{ $inventory->createdBy->name }}
                    </td>

                    <td>
                        {{ $inventory->created_at}}
                    </td>

                    <td>
                        {{$inventory->status}}
                    </td>

                    <td>
                        {{$inventory->files->count()}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            No Data
        @endif



        @yield('content')
    </div>

    <form action="{{$unit == 'Kg' ?  route('inventories.powder.store')  :  route('inventories.nonpowder.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="adjustmentModal" tabindex="-1" role="dialog" aria-labelledby="adjustmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adjustmentModalLabel">{{$product->name}} : Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                        <input type="hidden" name="category" value="{{$product->category->name}}">

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="any">
                        </div>

                        @if($unit == 'Kg')
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option value="">---</option>
                                    <option value="g">grams</option>
                                    <option value="kg">kilograms</option>
                                    <option value="lb">pounds</option>
                                </select>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="action">Method</label>
                            <select name="action" id="action" class="form-control">
                                <option value="">---</option>
                                <option value="add">Add</option>
                                @if($total->sum('amount') > 0)
                                    <option value="remove">Remove</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea name="reason" class="form-control"></textarea>
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

    <form action="{{$unit == 'Kg' ?  route('inventories.powder.receive')  :  route('inventories.nonpowder.receive') }}" method="POST">
        @csrf
        <div class="modal fade" id="receiveModal" tabindex="-1" role="dialog" aria-labelledby="receiveModalModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="receiveModalModalLabel">{{$product->name}} : Receive from Shipment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" step="any">
                        </div>

                        @if($unit == 'Kg')
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option value="">---</option>
                                    <option value="g">grams</option>
                                    <option value="kg">kilograms</option>
                                    <option value="lb">pounds</option>
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                                <label for="lot">Lot</label>
                                <input type="text" name="lot" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="production_date">Expiration date</label>
                            <input type="text" name="expiration_date" id="expiration_date" class="form-control">
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

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function handleAdjustment() {
            console.log('Opening Modal from products.show.blade.php file scripts section')

            $('#adjustmentModal').modal('show')
        }

        function handleReceive() {
            console.log('Opening Modal from products.show.blade.php file scripts section')

            $('#receiveModal').modal('show')
        }

        flatpickr('#expiration_date', {
        })
    </script>
@endsection