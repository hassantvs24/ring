@extends('layouts.master')
@extends('accounts.box.account')

@section('title')
    Accounts
@endsection

@section('content')


    <x-page name="Accounts" body="Add New Account">

        <table class="table table-striped table-condensed table-hover datatable-basic">
            <thead>
            <tr>
                <th class="p-th">Name</th>
                <th class="p-th">Account Number</th>
                <th class="p-th">Descriptions</th>
                <th class="text-right"><i class="icon-more"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($table as $row)
                <tr>
                    <td class="p-td">{{$row->name}}</td>
                    <td class="p-td">{{$row->account_number}}</td>
                    <td class="p-td">{{$row->description}}</td>
                    <td class="text-right p-td">
                        <x-actions>
                            <li><a href="{{route('accounts.update', ['list' => $row->id])}}"
                                   data-name="{{$row->name}}"
                                   data-acnumber="{{$row->account_number}}"
                                   data-description="{{$row->description}}"
                                   class="ediItem" data-toggle="modal" data-target="#ediModal"><i class="icon-pencil6 text-success"></i> Edit</a></li>
                            <li><a href="{{route('accounts.destroy', ['list' => $row->id])}}" class="delItem"><i class="icon-bin text-danger"></i> Delete</a></li>
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
            $('.ediItem').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var name = $(this).data('name');
                var account_number = $(this).data('acnumber');
                var description = $(this).data('description');

                $('#ediModal form').attr('action', url);
                $('#ediModal [name=name]').val(name);
                $('#ediModal [name=account_number]').val(account_number);
                $('#ediModal [name=description]').val(description);

            });


            $('.datatable-basic').DataTable({
                columnDefs: [
                    { orderable: false, "targets": [3] }
                ]
            });
        });
    </script>
@endsection