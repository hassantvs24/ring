@extends('layouts.master')

@section('title')
    Sales Report
@endsection
@section('content')

    <div class="row">

        <div class="col-md-5">
            <x-rpnl name="Product Stock Transaction" action="{{route('reports.stock-transaction')}}">
                <x-dinput class="date_pic" name="date_range" label="Date Range" required="required">
                    <x-slot name="addon"><i class="icon-calendar2"></i></x-slot>
                </x-dinput>
                <x-dselect label="Product" class="products" name="products_id" required="">
                    <option value="">Select Product (Optional)</option>

                </x-dselect>
            </x-rpnl>
        </div>

    </div>

@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection