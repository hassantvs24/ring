@section('box')

    <x-modal id="myModal" action="{{route('expense-category.store')}}" title="Add New Accounts" icon="grid5">
        <x-input name="name" label="Accounts Name" required="required" />
        <x-input name="account_number" label="Account Number"/>
        <x-input name="description" label="Descriptions"/>
    </x-modal>


    <x-modal id="ediModal" action="#" title="Edit Accounts" bg="success" icon="pencil6">
        @method('PUT')
        <x-input name="name" label="Accounts Name" required="required" />
        <x-input name="account_number" label="Account Number"/>
        <x-input name="description" label="Descriptions"/>
    </x-modal>

@endsection
