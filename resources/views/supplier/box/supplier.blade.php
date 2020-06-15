@section('box')

    <x-modal id="myModal" action="{{route('supplier.store')}}" title="Add New Supplier" icon="grid5">

        <x-select class="warehouse" name="warehouses_id" label="Select Warehouse" required="required" >
            @foreach($warehouse as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
        </x-select>

        <x-select class="category" name="supplier_categories_id" label="Supplier Category" required="required" >
            @foreach($category as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
        </x-select>

        <x-input name="code" label="Serial Number" value="{{mt_rand()}}" required="required" />
        <x-input name="name" label="Customer Name" required="required" />
        <x-input name="contact" label="Contact Number" required="required"  />
        <x-input type="email" name="email" label="Email Address" />
        <x-input name="phone" label="Phone Number" />
        <x-input name="alternate_contact" label="Alternate Contact" />
        <x-input name="address" label="Address" />
        <x-input type="number" name="balance"  rest="step=any min=0" value="0" label="Opening Due" required="required" />
        <x-input name="description" label="Additional Note" />

    </x-modal>


    <x-modal id="ediModal" action="#" title="Edit Supplier information" bg="success" icon="pencil6">
        @method('PUT')

        <x-select name="warehouses_id" label="Select Warehouse" required="required" >
            @foreach($warehouse as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
        </x-select>

        <x-select name="supplier_categories_id" label="Supplier Category" required="required" >
            @foreach($category as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
        </x-select>

        <x-input name="code" label="Serial Number" required="required" />
        <x-input name="name" label="Customer Name" required="required" />
        <x-input name="contact" label="Contact Number" required="required"  />
        <x-input type="email" name="email" label="Email Address" />
        <x-input name="phone" label="Phone Number" />
        <x-input name="alternate_contact" label="Alternate Contact" />
        <x-input name="address" label="Address" />
        <x-input type="number" name="balance"  rest="step=any min=0" value="0" label="Opening Due" required="required" />
        <x-input name="description" label="Additional Note" />

    </x-modal>

@endsection
