@extends('layouts.master')

@section('title')
    Expense Report
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-rpnl name="Action Report" action="{{route('reports.expense-report')}}">
                <x-dinput class="date_pic" name="date_range" label="Date Range" required="required">
                    <x-slot name="addon"><i class="icon-calendar2"></i></x-slot>
                </x-dinput>
                <x-dselect addon="Expense Category" class="category" name="date_range" required="required">
                    <option>Select Expanse Category (Optional)</option>
                </x-dselect>
            </x-rpnl>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $('.category').select2();

        $('.date_pic').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    </script>
@endsection