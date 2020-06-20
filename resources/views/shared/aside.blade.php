<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->

                    <li class="{{Route::currentRouteName() == 'index' ? 'active':''}}"><a href="{{route('index')}}"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

                    <li class="navigation-divider"></li>

                    <li class=""><a href="#"><i class=" icon-cart5"></i> <span>Sales</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'sales.index' ? 'active':''}}"><a href="{{route('sales.index')}}"><i class="icon-diamond"></i> Add Sales</a></li>
                            <li class="{{Route::currentRouteName() == 'sales-list.index' ? 'active':''}}"><a href="{{route('sales-list.index')}}"><i class="icon-diamond"></i> Invoice List</a></li>
                            <li class="{{Route::currentRouteName() == 'sales.quotation' ? 'active':''}}"><a href="{{route('sales.quotation')}}"><i class="icon-diamond"></i> Quotations List</a></li>
                            <li class="{{Route::currentRouteName() == 'sales.draft' ? 'active':''}}"><a href="{{route('sales.draft')}}"><i class="icon-diamond"></i> Draft List</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><i class=" icon-users4"></i> <span>Customers</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'customer.index' ? 'active':''}}"><a href="{{route('customer.index')}}"><i class="icon-diamond"></i> Customers List</a></li>
                            <li class="{{Route::currentRouteName() == 'customer-category.index' ? 'active':''}}"><a href="{{route('customer-category.index')}}"><i class="icon-diamond"></i> Customers Category</a></li>
                        </ul>
                    </li>

                    <li class="navigation-divider"></li>

                    <li class=""><a href="#"><i class=" icon-truck"></i> <span>Stock</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'products.index' ? 'active':''}}"><a href="{{route('products.index')}}"><i class="icon-diamond"></i> Product List</a></li>
                            <li class="{{Route::currentRouteName() == 'product-category.index' ? 'active':''}}"><a href="{{route('product-category.index')}}"><i class="icon-diamond"></i> Product Category</a></li>
                            <li class="{{Route::currentRouteName() == 'units.index' ? 'active':''}}"><a href="{{route('units.index')}}"><i class="icon-diamond"></i> Units</a></li>
                            <li class="{{Route::currentRouteName() == 'brand.index' ? 'active':''}}"><a href="{{route('brand.index')}}"><i class="icon-diamond"></i> Brands</a></li>
                            <li class="{{Route::currentRouteName() == 'company.index' ? 'active':''}}"><a href="{{route('company.index')}}"><i class="icon-diamond"></i> Company</a></li>
                            <li class="{{Route::currentRouteName() == 'adjustment.index' ? 'active':''}}"><a href="{{route('adjustment.index')}}"><i class="icon-diamond"></i> Stock Adjustment</a></li>
                        </ul>
                    </li>

                    <li class="navigation-divider"></li>

                    <li class=""><a href="#"><i class=" icon-cart"></i> <span>Purchase</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'purchase.index' ? 'active':''}}"><a href="{{route('purchase.index')}}"><i class="icon-diamond"></i> Add Purchase</a></li>
                            <li class="{{Route::currentRouteName() == 'purchase-list.index' ? 'active':''}}"><a href="{{route('purchase-list.index')}}"><i class="icon-diamond"></i> Purchase List</a></li>
                            <li class="{{Route::currentRouteName() == 'purchase.pending' ? 'active':''}}"><a href="{{route('purchase.pending')}}"><i class="icon-diamond"></i> Pending List</a></li>
                            <li class="{{Route::currentRouteName() == 'purchase.ordered' ? 'active':''}}"><a href="{{route('purchase.ordered')}}"><i class="icon-diamond"></i> Ordered List</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><i class=" icon-user-plus"></i> <span>Suppliers</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'supplier.index' ? 'active':''}}"><a href="{{route('supplier.index')}}"><i class="icon-diamond"></i> Suppliers List</a></li>
                            <li class="{{Route::currentRouteName() == 'supplier-category.index' ? 'active':''}}"><a href="{{route('supplier-category.index')}}"><i class="icon-diamond"></i> Suppliers Category</a></li>
                        </ul>
                    </li>

                    <li class="navigation-divider"></li>

                    <li class=""><a href="#"><i class=" icon-box-remove"></i> <span>Expenses</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'expenses.index' ? 'active':''}}"><a href="{{route('expenses.index')}}"><i class="icon-diamond"></i> All Expenses</a></li>
                            <li class="{{Route::currentRouteName() == 'expense-category.index' ? 'active':''}}"><a href="{{route('expense-category.index')}}"><i class="icon-diamond"></i> Expense Category</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><i class=" icon-calculator3"></i> <span>Payment Account</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'accounts.index' ? 'active':''}}"><a href="{{route('accounts.index')}}"><i class="icon-diamond"></i> Accounts List</a></li>
                            <li class=""><a href=""><i class="icon-diamond"></i> Balance Sheet</a></li>
                            <li class=""><a href=""><i class="icon-diamond"></i> Trial Balance</a></li>
                            <li class=""><a href=""><i class="icon-diamond"></i> Cash Flow</a></li>
                            <li class=""><a href=""><i class="icon-diamond"></i> Accounts Reports</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><i class=" icon-users"></i> <span>Users</span></a>
                        <ul>
                            <li class=""><a href=""><i class="icon-diamond"></i> All Users</a></li>
                            <li class=""><a href=""><i class="icon-diamond"></i> User Roles</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><i class=" icon-hammer-wrench"></i> <span>Settings</span></a>
                        <ul>
                            <li class="{{Route::currentRouteName() == 'business.show' ? 'active':''}}"><a href="{{route('business.show', ['business' => Auth::user()->business_id])}}"><i class="icon-diamond"></i> Business Setup</a></li>
                            <li class="{{Route::currentRouteName() == 'warehouse.index' ? 'active':''}}"><a href="{{route('warehouse.index')}}"><i class="icon-diamond"></i> Warehouse</a></li>
                            <li class="{{Route::currentRouteName() == 'discount.index' ? 'active':''}}"><a href="{{route('discount.index')}}"><i class="icon-diamond"></i> Discount</a></li>
                            <li class="{{Route::currentRouteName() == 'vat-tax.index' ? 'active':''}}"><a href="{{route('vat-tax.index')}}"><i class="icon-diamond"></i> Vat Tax</a></li>
                            <li class="{{Route::currentRouteName() == 'shipment.index' ? 'active':''}}"><a href="{{route('shipment.index')}}"><i class="icon-diamond"></i> Shipment</a></li>
                            <li class="{{Route::currentRouteName() == 'zone.index' ? 'active':''}}"><a href="{{route('zone.index')}}"><i class="icon-diamond"></i> Zone</a></li>
                        </ul>
                    </li>

                    <li class=""><a href="#"><i class=" icon-chart"></i> <span>Reports</span></a>
                        <ul>
                            <li class=""><a href=""><i class="icon-diamond"></i> Summery Reports</a></li>
                        </ul>
                    </li>

                    <li class="navigation-divider"></li>

                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>
<!-- /main sidebar -->