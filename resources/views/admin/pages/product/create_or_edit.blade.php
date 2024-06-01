@extends('admin.layouts.master')

@section('title') {{ isset($product) ? 'Edit Product' : 'Add New Product' }} @endsection

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</strong></h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="shadow rounded m-1 border p-2 mb-3">
                                <form action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($product))
                                        @method('PUT')
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ isset($product) ? $product->title : '' }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="thumbnail_image" class="form-label">Thumbnail Image</label>
                                            <input type="file" class="form-control" id="thumbnail_image" name="thumbnail_image">
                                            @if(isset($product) && $product->thumbnail_image)
                                                <img src="{{ asset('images/' . $product->thumbnail_image) }}" alt="Thumbnail" class="img-thumbnail mt-2" style="width: 100px;">
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="gallery_images" class="form-label">Gallery Images</label>
                                            <input type="file" class="form-control" id="gallery_images" multiple name="gallery_images[]">
                                            @if(isset($product) && count($product->galleries) > 0)
                                                <div class="mt-2">
                                                    @foreach($product->galleries as $image)
                                                        <img src="{{ asset('images/' . $image->image) }}" class="img-thumbnail mr-2" style="width: 100px;">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="min_order_qty" class="form-label">Minimum Order Quantity</label>
                                            <input type="number" class="form-control" id="min_order_qty" name="min_order_qty" value="{{ isset($product) ? $product->min_order_qty : '1' }}" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="unit_type" class="form-label">Unit Type</label>
                                            <input type="text" class="form-control" id="unit_type" name="unit_type" value="{{ isset($product) ? $product->unit_type : 'pcs' }}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="serial_number" class="form-label">Serial / SKU Number</label>
                                            <input type="text" class="form-control" id="serial_number" placeholder="If you leave empty, it will generate automatically." name="serial_number" value="{{ isset($product) ? $product->serial_number : '' }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ isset($product) ? $product->price : '' }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="original_or_copy" class="form-label">Original or Copy</label>
                                            <select class="form-control" id="original_or_copy" name="original_or_copy">
                                                <option value="original" {{ isset($product) && $product->original_or_copy == 'original' ? 'selected' : '' }}>Original</option>
                                                <option value="copy" {{ isset($product) && $product->original_or_copy == 'copy' ? 'selected' : '' }}>Copy</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="descriptions" class="form-label">Descriptions</label>
                                            <textarea class="form-control" id="descriptions" name="descriptions">{{ isset($product) ? $product->descriptions : '' }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Create Product' }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('descriptions');
</script>
@endsection
