<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('account.dashboard') }}">
            <span class="align-middle">Ecommerce Demo</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item {{ isActiveRoute(['account.dashboard']) }}">
                <a class="sidebar-link" href="{{ route('account.dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('account.profile', ['id' =>  encrypt(Auth::user()->id)]) }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">My Business Profile</span>
                </a>
            </li>
            
            @if(optional(Auth::user())->account_type == 'super_admin')
            <li class="sidebar-header">
                Seller
            </li>
            <li class="sidebar-item {{ isActiveRoute(['seller.create']) }}">
                <a class="sidebar-link" href="{{ route('seller.create') }}">
                    <i class="align-middle" data-feather="arrow-down-circle"></i> <span class="align-middle">Add New Seller</span>
                </a>
            </li>

            <li class="sidebar-item {{ isActiveRoute(['seller.list']) }}">
                <a class="sidebar-link" href="{{ route('seller.list') }}">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Seller List</span>
                </a>
            </li>
            @endif

            <li class="sidebar-header">
                Products
            </li>
            <li class="sidebar-item {{ isActiveRoute(['product.create']) }}">
                <a class="sidebar-link" href="{{ route('product.create') }}">
                    <i class="align-middle" data-feather="arrow-up-circle"></i> <span class="align-middle">Add New Product</span>
                </a>
            </li>
            <li class="sidebar-item {{ isActiveRoute(['product.index']) }}">
                <a class="sidebar-link" href="{{ route('product.index') }}">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">All Products</span>
                </a>
            </li>
            
        </ul>
    </div>
</nav>
