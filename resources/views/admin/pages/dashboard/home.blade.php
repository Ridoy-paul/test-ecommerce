@extends('admin.layouts.master')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Products</h5>
                            <h1 class="mt-1 mb-3">{{ $data['totalProducts'] }}</h1>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->account_type == 'super_admin')
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Sellers</h5>
                            <h1 class="mt-1 mb-3">{{ $data['totalSellers'] }}</h1>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
