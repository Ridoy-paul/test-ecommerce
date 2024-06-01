@extends('admin.layouts.master')

@section('title')Make Deposit @endsection

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Make Deposit</strong></h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="shadow rounded m-1 border p-2 mb-3">
                                <form action="{{ route('transaction.deposit.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                      <label for="amount" class="form-label">Amount</label>
                                      <input type="number" min="1" class="form-control" id="amount" step=any name="amount" required>
                                      @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Confirm Deposit</button>
                                    </div>
                                  </form>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="shadow rounded m-1 border p-2 mb-3">
                                <x-current-balance-component />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


