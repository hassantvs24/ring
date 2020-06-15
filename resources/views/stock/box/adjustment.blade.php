@section('box')

    <x-modal id="myModal" action="{{route('adjustment.store')}}" size="modal-full" title="Stock Adjustment" icon="grid5">
        <div class="row">
            <div class="col-md-6">
                <x-input name="code" label="Reference Number" required="required" />
                <x-input name="recover_amount" type="number" label="Recover Amount" rest="step=any min=0"  value="0" required="required" />
            </div>
            <div class="col-md-6">
                <x-select class="warehouses" name="warehouses_id" label="Warehouse">
                    @foreach($warehouse as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </x-select>
                <x-input name="description" label="Adjustment Note" />
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="input-group has-success">
                    <span class="input-group-addon" id="basic-addon1">Add Item</span>
                    <select class="form-control products">
                        <option value="">Select Product</option>
                        @foreach($products as $row)
                            <option value="{{$row->id}} -x- {{$row->sku}} -x- {{$row->name}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-12 mb-20">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Action</th>
                        <th class="text-right"><i class="icon-bin"></i></th>
                    </tr>
                    </thead>
                    <tbody class="item_list">
                        <!-- Loading Item List -->
                    </tbody>
                </table>
            </div>
        </div>

    </x-modal>


    <x-modal id="ediModal" action="#" title="Edit Product" size="modal-full" bg="success" icon="pencil6">
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <x-input name="code" label="Reference Number" required="required" />
                <x-input name="recover_amount" type="number" label="Recover Amount" rest="step=any min=0"  value="0" required="required" />
            </div>
            <div class="col-md-6">
                <x-select name="warehouses_id" label="Warehouse">
                    @foreach($warehouse as $row)
                        <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                </x-select>
                <x-input name="description" label="Adjustment Note" />
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="input-group has-success">
                    <span class="input-group-addon" id="basic-addon1">Add Item</span>
                    <select class="form-control products">
                        <option value="">Select Product</option>
                        @foreach($products as $row)
                            <option value="{{$row->id}} -x- {{$row->sku}} -x- {{$row->name}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-md-12 mb-20">
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Action</th>
                        <th class="text-right"><i class="icon-bin"></i></th>
                    </tr>
                    </thead>
                    <tbody class="item_list">
                    <!-- Loading Item List -->
                    </tbody>
                </table>
            </div>
        </div>

    </x-modal>

@endsection
