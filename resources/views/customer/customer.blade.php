@extends('layouts.master')
@extends('customer.box.customer')

@section('title')
    Customer
@endsection

@section('content')


    <x-page name="Customer List" body="Add New Customer">

        <table class="table table-striped table-condensed table-hover datatable-basic">
            <thead>
            <tr>
                <th class="p-th">S/N</th>
                <th class="p-th">Name</th>
                <th class="p-th">Contact</th>
                <th class="p-th">Email</th>
                <th class="p-th">Address</th>
                <th class="p-th">Phone</th>
                <th class="p-th">Contact2</th>
                <th class="p-th">Zone</th>
                <th class="p-th">Category</th>
                <th class="p-th">Warehouse</th>
                <th title="Credit Limit" class="p-th">Cr.Limit</th>
                <th class="p-th">Target</th>
                <th class="p-th">Balance</th>
                <th class="text-right"><i class="icon-more"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($table as $row)
                <tr>
                    <td class="p-td">{{$row->code}}</td>
                    <td class="p-td">{{$row->name}}</td>
                    <td class="p-td">{{$row->contact}}</td>
                    <td class="p-td">{{$row->email}}</td>
                    <td class="p-td">{{$row->address}}</td>
                    <td class="p-td">{{$row->phone}}</td>
                    <td class="p-td">{{$row->alternate_contact}}</td>
                    <td class="p-td">{{$row->zone['name']}}</td>
                    <td class="p-td">{{$row->customerCategory['name']}}</td>
                    <td class="p-td">{{$row->warehouse['name']}}</td>
                    <td class="p-td">{{$row->credit_limit}}</td>
                    <td class="p-td">{{$row->sells_target}}</td>
                    <td class="p-td">{{$row->dueBalance()}}</td>
                    <td class="text-right p-td">
                        <x-actions>
                            <li><a href="{{route('customer.update', ['list' => $row->id])}}"
                                   data-code="{{$row->code}}"
                                   data-name="{{$row->name}}"
                                   data-contact="{{$row->contact}}"
                                   data-email="{{$row->email}}"
                                   data-address="{{$row->address}}"
                                   data-phone="{{$row->phone}}"
                                   data-contacttwo="{{$row->alternate_contact}}"
                                   data-zone="{{$row->zones_id}}"
                                   data-category="{{$row->customer_categories_id}}"
                                   data-warehouse="{{$row->warehouses_id}}"
                                   data-crlimit="{{$row->credit_limit}}"
                                   data-starget="{{$row->sells_target}}"
                                   data-balance="{{$row->balance}}"
                                   data-description="{{$row->description}}"
                                   class="ediItem" data-toggle="modal" data-target="#ediModal"><i class="icon-pencil6 text-success"></i> Edit</a></li>
                            <li><a href="{{route('customer.destroy', ['list' => $row->id])}}" class="delItem"><i class="icon-bin text-danger"></i> Delete</a></li>
                        </x-actions>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </x-page>


@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $('.warehouse').val("{{auth()->user()->warehouses_id}}");

            $('.warehouse').select2();
            $('.category').select2();
            $('.zone').select2();

            $('.ediItem').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var name = $(this).data('name');
                var code = $(this).data('code');
                var email = $(this).data('email');
                var address = $(this).data('address');
                var phone = $(this).data('phone');
                var alternate_contact = $(this).data('contacttwo');
                var zones_id = $(this).data('zone');
                var contact = $(this).data('contact');
                var warehouses_id = $(this).data('warehouse');
                var credit_limit = $(this).data('crlimit');
                var sells_target = $(this).data('starget');
                var balance = $(this).data('balance');
                var customer_categories_id = $(this).data('category');
                var description = $(this).data('description');

                $('#ediModal form').attr('action', url);
                $('#ediModal [name=name]').val(name);
                $('#ediModal [name=code]').val(code);
                $('#ediModal [name=email]').val(email);
                $('#ediModal [name=address]').val(address);
                $('#ediModal [name=phone]').val(phone);
                $('#ediModal [name=alternate_contact]').val(alternate_contact);
                $('#ediModal [name=contact]').val(contact);
                $('#ediModal [name=credit_limit]').val(credit_limit);
                $('#ediModal [name=sells_target]').val(sells_target);
                $('#ediModal [name=balance]').val(balance);
                $('#ediModal [name=description]').val(description);

                $('#ediModal [name=zones_id]').val(zones_id).select2();
                $('#ediModal [name=warehouses_id]').val(warehouses_id).select2();
                $('#ediModal [name=customer_categories_id]').val(customer_categories_id).select2();

            });


            $('.datatable-basic').DataTable({
                columnDefs: [
                    { orderable: false, "targets": [13] }
                ]
            });
        });
    </script>
@endsection