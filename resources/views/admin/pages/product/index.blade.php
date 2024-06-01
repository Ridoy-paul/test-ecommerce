@extends('admin.layouts.master')
@section('title')All Products @endsection
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>All Products</strong></h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Seller Name</th>
                                <th>SKU / Serial</th>
                                <th>Price</th>
                                <th>Created At</th>
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
@endsection

@section('script')
<script type="text/javascript">
    $(function () {
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('product.index') }}",
          columns: [
              {data: 'title', name: 'title'},
              {data: 'seller_name', name: 'seller_name'},
              {data: 'serial_number', name: 'serial_number'},
              {data: 'price', name: 'price'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action'},
          ],
          "scrollY": "300px",
          "pageLength": 100,
          "ordering": false,
      });
          
    });
  </script>
@endsection


