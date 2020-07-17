@extends('layouts.printx')

@section('title')
    Party Ledger Reports
@endsection
@section('content')
    <x-print header="Customer Ledger Report">
        <x-slot name="sub">
            <x-bp b="Date Range">{{$request['date_range']}}</x-bp>
        </x-slot>
        <x-slot name="subr"><x-bp b="Report Date">{{date('d/m/Y')}}</x-bp></x-slot>

        <table class="table table-condensed table-bordered table-striped">
            <thead>
            <tr>
                <th>Party Name</th>
                <th>Address</th>
                <th>Qty</th>
                <th>Delivery Amount</th>
                <th>Collection</th>
                <th>Last Collection</th>
                <th>Cr. Limit</th>
                <th>Balance</th>
                <th>Target</th>
                <th>Agent</th>
            </tr>
            </thead>
            <tbody>
            @php
               // $total = 0;
            @endphp
            @foreach($table as $row)
                @php
                     $last_collect = $row->transactions()
                     ->whereBetween('created_at', $range)
                     ->where('transaction_type', 'IN')
                     ->where('status', 'Active')
                     ->orderBy('created_at', 'desc')
                     ->first();

                     $collect = $row->transactions()
                     ->whereBetween('created_at', $range)
                     ->where('transaction_type', 'IN')
                     ->where('status', 'Active')
                     ->sum('amount');

                     $invoices = $row->sellInvoices()
                     ->whereBetween('created_at', $range)
                     ->where('status', 'Final')
                     ->get();

                     $qty = 0;
                     $amount = 0;
                     foreach ($invoices as $rows){
                        $products = $rows->main_product();
                        $qty += $products['qty'];
                        $amount += $products['amount'];
                     }

                //dd($last_collect->created_at);

                @endphp
                <tr>
                    <td>{{$row->name}}</td>
                    <td>{{$row->address}}</td>
                    <td>{{$qty}}</td>
                    <td>{{money_c($amount)}}</td>
                    <td>{{money_c($collect)}}</td>
                    @if(isset($last_collect->created_at))
                        <td>{{pub_date($last_collect->created_at)}}</td>
                    @else
                        <td>--</td>
                    @endif
                    <td>{{money_c($row->credit_limit)}}</td>
                    <td>{{money_c($row->dueBalance())}}</td>
                    <td>{{$row->sells_target}}</td>
                    <td>{{$row->agent['name'] ?? ''}}</td>

                </tr>
                @php
                   // $total += $row->amount;
                @endphp
            @endforeach
            </tbody>
        </table>
    </x-print>

@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection