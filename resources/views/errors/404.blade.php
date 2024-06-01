@extends('admin.layouts.master')

@section('title')
Error 404
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center mt-1">
                <span style="font-size: 150px; font-weight: bold;">404</span>
                <h1>Page Not Found</h1>
                <p>Sorry, the page you are looking for could not be found.</p>
                <span class="text-danger">{{ $exception->getMessage() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection



