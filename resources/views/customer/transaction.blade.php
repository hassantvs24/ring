@extends('layouts.master')
@extends('customer.box.transaction')
@section('title')
    {{$customer->name}} - Payment Transaction
@endsection
@section('content')

    <div class="mb-15">
        <a href="{{route('customer.index')}}" class="btn btn-danger heading-btn btn-labeled btn-labeled-left"><b><i class="icon-arrow-left5"></i></b> Back to customer list</a>
    </div>

    <x-page name="{{$customer->name}} - Payment Transaction" body="New payment">



        <table class="table table-striped table-condensed table-hover datatable-basic">
            <thead>
            <tr>
                <th class="p-th">Date</th>
                <th class="p-th">Account Book</th>
                <th class="p-th">Payment Method</th>
                <th class="p-th">Payment Section</th>
                <th class="p-th">Cheque</th>
                <th class="p-th">A/C No</th>
                <th class="p-th">Ref. No</th>
                <th class="p-th">Description</th>
                <th class="p-th">IN</th>
                <th class="p-th">OUT</th>
                <th class="text-right"><i class="icon-more"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($table as $row)
                <tr>
                    <td class="p-td">{{pub_date($row->created_at)}}</td>
                    <td class="p-td">{{$row->accountBook['name']}}</td>
                    <td class="p-td">{{$row->payment_method}}</td>
                    <td class="p-td">{{$row->payment_type}}</td>
                    <td class="p-td">{{$row->cheque_number}}</td>
                    <td class="p-td">{{$row->bank_account_no}}</td>
                    <td class="p-td">{{$row->transaction_no}}</td>
                    <td class="p-td">{{$row->description}}</td>
                    <td class="p-td">{{money_c($row->transaction_type == 'IN' ? $row->amount : 0)}}</td>
                    <td class="p-td">{{money_c($row->transaction_type == 'OUT' ? $row->amount : 0)}}</td>
                    <td class="text-right p-td">
                        <x-actions>
                            <!--<li><a href="{{route('customer.edit-payment', ['id' => $row->id, 'customer' => $customer->id])}}"
                                   data-acbook="{{$row->account_books_id}}"
                                   data-pmethod="{{$row->payment_method}}"
                                   data-ptype="{{$row->payment_type}}"
                                   data-cheque="{{$row->cheque_number}}"
                                   data-bac="{{$row->bank_account_no}}"
                                   data-trno="{{$row->transaction_no}}"
                                   data-description="{{$row->description}}"
                                   data-amount="{{$row->amount}}"
                                   data-warehouses="{{$row->warehouses_id}}"
                                   class="ediItem" data-toggle="modal" data-target="#ediModal"><i class="icon-pencil6 text-success"></i> Edit</a></li>-->
                            <li><a href="{{route('customer.del-payment', ['id' => $row->id])}}" class="delItem"><i class="icon-bin text-danger"></i> Delete</a></li>
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
        var balance = Number("{{$customer->dueBalance()}}");

        $(function () {
            $('.warehouse').val("{{auth()->user()->warehouses_id}}");

            $('.warehouse, .accounts, .payment_method').select2();

            $('.ediItem').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var warehouses_id = $(this).data('warehouses');
                var account_books_id = $(this).data('acbook');
                var payment_method = $(this).data('pmethod');
                var payment_type = $(this).data('ptype');
                var cheque_number = $(this).data('cheque');
                var transaction_no = $(this).data('trno');
                var bank_account_no = $(this).data('bac');
                var description = $(this).data('description');
                var amount = $(this).data('amount');


                $('#ediModal form').attr('action', url);
                $('#ediModal [name=warehouses_id]').val(warehouses_id).select2();
                $('#ediModal [name=account_books_id]').val(account_books_id).select2();
                $('#ediModal [name=payment_method]').val(payment_method).select2();
                $('#ediModal [name=payment_type]').val(payment_type).select2();
                $('#ediModal [name=cheque_number]').val(cheque_number);
                $('#ediModal [name=transaction_no]').val(transaction_no);
                $('#ediModal [name=bank_account_no]').val(bank_account_no);
                $('#ediModal [name=description]').val(description);
                $('#ediModal [name=amount]').val(amount);


                $('#ediModal [name=zones_id]').val(zones_id).select2();
                $('#ediModal [name=warehouses_id]').val(warehouses_id).select2();
                $('#ediModal [name=customer_categories_id]').val(customer_categories_id).select2();

            });


            $('.payment_method').change(function () {
                var methods = $(this).val();
                switch(methods) {
                    case "Cheque":
                        $('.cheque_number').show();
                        $('.bank_account_no').hide();
                        $('.transaction_no').hide();
                        $('.customer_balance').hide();
                        break;
                    case "Bank Transfer":
                        $('.cheque_number').hide();
                        $('.bank_account_no').show();
                        $('.transaction_no').hide();
                        $('.customer_balance').hide();
                        break;
                    case "Other":
                        $('.cheque_number').hide();
                        $('.bank_account_no').hide();
                        $('.transaction_no').show();
                        $('.customer_balance').hide();
                        break;
                    case "Customer Account":
                        $('.customer_balance').html('Account Current Balance: '+parseFloat(balance).toFixed(2));
                        $('.cheque_number').hide();
                        $('.bank_account_no').hide();
                        $('.transaction_no').hide();
                        $('.customer_balance').show();
                        break;
                    default:
                        $('.cheque_number').hide();
                        $('.bank_account_no').hide();
                        $('.transaction_no').hide();
                        $('.customer_balance').hide();
                }

                disible_submit();

            });

            $('#myModal [name=amount]').on('keyup keydown change', function () {
                disible_submit();
            });


            $('.datatable-basic').DataTable({
                columnDefs: [
                     { orderable: false, "targets": [10] }
                ]
            });
        });

        function disible_submit() {
            var amount = $('#myModal [name=amount]').val();
            var payment_method = $('.payment_method').val();

            if(amount <= 0 || amount > balance && payment_method == 'Customer Account'){
                $('#myModal [type=submit]').prop('disabled', true);
            }else{
                $('#myModal [type=submit]').prop('disabled', false);
            }
        }
    </script>
@endsection