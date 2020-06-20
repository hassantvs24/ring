@extends('layouts.master')

@section('title')
    Customer Payment Transaction
@endsection
@section('content')


    <x-page name="Customer Payment Transaction">

        <table class="table table-striped table-condensed table-hover datatable-basic">
            <thead>
            <tr>
                <th class="p-th">Date</th>
                <th class="p-th">SKU</th>
                <th class="p-th">Name</th>
                <th class="p-th">Transaction Point</th>
                <th class="p-th">IN</th>
                <th class="p-th">OUT</th>
                <th class="p-th">Unit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($table as $row)
                <tr>
                    <td class="p-td">{{pub_date($row->created_at)}}</td>
                    <td class="p-td">{{$row->sku}}</td>
                    <td class="p-td">{{$row->name}}</td>
                    <td class="p-td">{{$row->transaction_point}}</td>
                    <td class="p-td">{{$row->transaction_type == 'IN' ? $row->quantity : 0}}</td>
                    <td class="p-td">{{$row->transaction_type == 'OUT' ? $row->quantity : 0}}</td>
                    <td class="p-td">{{$row->unit}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-page>


@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $('.datatable-basic').DataTable({
                columnDefs: [
                    // { orderable: false, "targets": [3] }
                ]
            });
        });
    </script>
@endsection