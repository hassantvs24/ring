@extends('layouts.master')

@section('title')
    Profit Lose Summery Report
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <x-rpnl name="Profit Lose Summery Report" action="{{route('reports.profit-loss_action')}}">
                <x-dinput class="date_pic" name="date_range" label="Date Range" required="required">
                    <x-slot name="addon"><i class="icon-calendar2"></i></x-slot>
                </x-dinput>
            </x-rpnl>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $(function () {

            $('.date_pic').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        });

    </script>
@endsection