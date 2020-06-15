@section('box')

    <x-modal id="myModal" action="{{route('customer.store')}}" size="modal-full" title="Add New Customer" icon="grid5">
        <div class="row">
            <div class="col-md-6">
                <x-select class="warehouse" name="warehouses_id" label="Select Warehouse" required="required" >
                    @foreach($warehouse as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </x-select>

                <x-select class="category" name="customer_categories_id" label="Customer Category" required="required" >
                    @foreach($category as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </x-select>

                <x-select class="category" name="zones_id" label="Supplier Category" required="required" >
                    @foreach($zone as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </x-select>

                <x-input name="code" label="Serial Number" required="required" value="{{mt_rand()}}" />
                <x-input name="name" label="Customer Name" required="required" />
                <x-input name="contact" label="Contact Number" required="required"  />
                <x-input type="email" name="email" label="Email Address" />

            </div>

            <div class="col-md-6">
                <x-input name="phone" label="Phone Number" />
                <x-input name="alternate_contact" label="Alternate Contact" />
                <x-input name="address" label="Address" />
                <x-input type="number" name="credit_limit"  rest="step=any min=0" value="0" label="Credit Limit" required="required" />
                <x-input type="number" name="sells_target"  rest="step=any min=0" value="0" label="Sells Target" required="required" />
                <x-input type="number" name="balance"  rest="step=any min=0" value="0" label="Opening Balance" required="required" />
                <x-input name="description" label="Additional Note" />
            </div>
        </div>


    </x-modal>


    <x-modal id="ediModal" action="#" title="Edit Customer" size="modal-full" bg="success" icon="pencil6">
        @method('PUT')
        <div class="col-md-6">
            <x-select name="warehouses_id" label="Select Warehouse" required="required" >
                @foreach($warehouse as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </x-select>

            <x-select name="customer_categories_id" label="Customer Category" required="required" >
                @foreach($category as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </x-select>

            <x-select name="zones_id" label="Supplier Category" required="required" >
                @foreach($zone as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </x-select>

            <x-input name="code" label="Serial Number" required="required" />
            <x-input name="name" label="Supplier Name" required="required" />
            <x-input name="contact" label="Contact Number" required="required"  />
            <x-input type="email" name="email" label="Email Address" />

        </div>

        <div class="col-md-6">
            <x-input name="phone" label="Phone Number" />
            <x-input name="alternate_contact" label="Alternate Contact" />
            <x-input name="address" label="Address" />
            <x-input type="number" name="credit_limit"  rest="step=any min=0" value="0" label="Credit Limit" required="required" />
            <x-input type="number" name="sells_target"  rest="step=any min=0" value="0" label="Sells Target" required="required" />
            <x-input type="number" name="balance"  rest="step=any min=0" value="0" label="Opening Balance" required="required" />
            <x-input name="description" label="Additional Note" />
        </div>
    </x-modal>

@endsection
