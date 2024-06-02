@extends('admin.layouts.master')
@section('title')Seller Lists @endsection
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Seller Lists</strong></h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>District</th>
                                <th>Product Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-delete-modal-box />

@endsection

@section('script')
<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('seller.list') }}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'district_name', name: 'district_name'},
              {data: 'product_qty', name: 'product_qty'},
              {data: 'action', name: 'action'},
          ],
          "scrollY": "300px",
          "pageLength": 100,
          "ordering": false,
      });
          
    });
  </script>
@endsection


