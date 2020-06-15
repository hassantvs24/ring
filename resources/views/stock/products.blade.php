@extends('layouts.master')
@extends('stock.box.products')

@section('title')
    Stock List
@endsection
@section('content')


    <x-page name="Stock List" body="Add Products">

        <table class="table table-striped table-condensed table-hover datatable-basic">
            <thead>
            <tr>
                <th class="p-th">S/N</th>
                <th class="p-th">Name</th>
                <th class="p-th">Type</th>
                <th class="p-th">Category</th>
                <th class="p-th">Brand</th>
                <th class="p-th">Company</th>
                <th title="Sales Price" class="p-th">S.Price</th>
                <th title="Purchase Price" class="p-th">P.Price</th>
                <th class="p-th">Stock</th>
                <th class="p-th">Unit</th>
                <th title="Alert Quantity" class="p-th">A.Qty</th>
                <th class="text-right"><i class="icon-more"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($table as $row)
                <tr>
                    <td class="p-td">{{$row->sku}}</td>
                    <td class="p-td">{{$row->name}}</td>
                    <td class="p-td">{{$row->product_type}}</td>
                    <td class="p-td">{{$row->productCategory['name']}}</td>
                    <td class="p-td">{{$row->brand['name']}}</td>
                    <td class="p-td">{{$row->company['name']}}</td>
                    <td class="p-td">{{$row->sell_price}}</td>
                    <td class="p-td">{{$row->purchase_price}}</td>
                    <td class="p-td">{{$row->stock}}</td>
                    <td class="p-td">{{$row->unit['name']}}</td>
                    <td class="p-td">{{$row->alert_quantity}}</td>
                    <td class="text-right p-td">
                        <x-actions>
                            <li><a href="{{route('products.update', ['product' => $row->id])}}"
                                   data-name="{{$row->name}}"
                                   data-sku="{{$row->sku}}"
                                   data-ptype="{{$row->product_type}}"
                                   data-category="{{$row->product_categories_id}}"
                                   data-brand="{{$row->brands_id}}"
                                   data-companies="{{$row->companies_id}}"
                                   data-sell="{{$row->sell_price}}"
                                   data-purchase="{{$row->purchase_price}}"
                                   data-stock="{{$row->stock}}"
                                   data-units="{{$row->units_id}}"
                                   data-aqty="{{$row->alert_quantity}}"
                                   data-description="{{$row->description}}"
                                   class="ediItem" data-toggle="modal" data-target="#ediModal"><i class="icon-pencil6 text-success"></i> Edit</a></li>
                            <li><a href="{{route('products.destroy', ['product' => $row->id])}}" class="delItem"><i class="icon-bin text-danger"></i> Delete</a></li>
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
                var sku = $(this).data('sku');
                var product_type = $(this).data('ptype');
                var product_categories_id = $(this).data('category');
                var brands_id = $(this).data('brand');
                var companies_id = $(this).data('companies');
                var sell_price = $(this).data('sell');
                var purchase_price = $(this).data('purchase');
                var stock = $(this).data('stock');
                var units_id = $(this).data('units');
                var alert_quantity = $(this).data('aqty');
                var description = $(this).data('description');

                $('#ediModal form').attr('action', url);
                $('#ediModal [name=name]').val(name);
                $('#ediModal [name=sku]').val(sku);
                $('#ediModal [name=product_type]').val(product_type).select2();
                $('#ediModal [name=product_categories_id]').val(product_categories_id).select2();
                $('#ediModal [name=brands_id]').val(brands_id).select2();
                $('#ediModal [name=companies_id]').val(companies_id).select2();
                $('#ediModal [name=sell_price]').val(sell_price);
                $('#ediModal [name=purchase_price]').val(purchase_price);
                $('#ediModal [name=stock]').val(stock);
                $('#ediModal [name=units_id]').val(units_id).select2();
                $('#ediModal [name=alert_quantity]').val(alert_quantity);
                $('#ediModal [name=description]').val(description);

            });

            $('.product_type, .category, .brands, .companies, .units').select2();


            $('.datatable-basic').DataTable({
                columnDefs: [
                    { orderable: false, "targets": [11] }
                ]
            });
        });
    </script>
@endsection