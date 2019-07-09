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
{{--                    <h4>Total: {{number_format($total->sum('amount'), 2)}} {{$unit}}</h4>--}}
                @else
                    <h4>Total: 0</h4>
                @endif
                <p>
                    @if(auth()->user()->email == 'innovativetim06@gmail.com')
                        <div>
                            <a href="{{ route('inventories.create', $product->id) }}" class="btn btn-info mb-2 mr-3">Rec In</a>
                        </div>
                    @else
                        @can('edit', $inventory)
                        <div>
                            <a href="{{ route('inventories.create', $product->id) }}" class="btn btn-info mb-2 mr-3">Rec In</a>
                        </div>
                        @endcan
                    @endif
                </p>
            </div>
        </section>

        @if($inventories->count() > 0)
        <table class="table">
            <thead>
            <th>Input Amount</th>
{{--            <th>Input Unit</th>--}}
            <th>Use Amount</th>
{{--            <th>Use Unit</th>--}}
            <th>Lot</th>
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
                                {{number_format($inventory->input_amount, 2)}} {{$inventory->input_unit}}
                            </a>
                        @else
                            {{number_format($inventory->input_amount, 2)}} {{$inventory->input_unit}}
                        @endcan
                    </td>

                    <td>
                        {{number_format($inventory->use_amount, 2)}}
                        @if($inventory->input_unit === 'ea')
                            ea
                        @else
                            KG
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('lot.show', $inventory->id) }}">
                            {{ $inventory->vendor_lot }}
                        </a>

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