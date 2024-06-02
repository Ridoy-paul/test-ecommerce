<div class="slide" data-slide-index="{{ $key }}">
    <div class="product-info">
        <div class="product-header">
            <div class="bg-light rounded p-2 m-1">
                <img src="{{ !empty($product->seller_info->image) ? asset('images/' . $product->seller_info->image) : asset('front_resources/img/seller.png') }}" style="width: 50px; height: 50px;">
            </div>
            <div class="bg-light rounded m-1">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <td colspan="2">{{ $product->title }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;">Min Order: {{ $product->min_order_qty }} {{ $product->unit_type }}</td>
                            <td style="font-size: 12px;">SL No: {{ $product->serial_number }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-light rounded p-2 m-1">
                <img src="{{ asset('front_resources/img/customer-review.png') }}" style="width: 50px; height: 50px;">
            </div>
        </div>
        <div class="text-center">
            <img width="100%" src="{{ asset('images/' . $product->thumbnail_image) }}" class="product-image">
        </div>
        <div class="product-footer">
            <div class="bg-light rounded p-2 m-1" data-created-at="{{ $product->created_at }}">
                <img src="{{ asset('front_resources/img/clock.png') }}" style="width: 20px; height: 20px;">
                <span style="font-size: 14px;" class="time-elapsed"></span>
            </div>
            <div class="bg-light rounded p-2 m-1">
                <img src="{{ asset('front_resources/img/map.png') }}" style="width: 20px; height: 20px;">
                <span>{{ $product->seller_info->district_info->name }}</span>
            </div>
            <div class="bg-light rounded p-2 m-1">
                <img src="{{ asset('front_resources/img/reward.png') }}" style="width: 20px; height: 20px;">
                <span>{{ $product->original_or_copy }}</span>
            </div>
        </div>
    </div>
</div>
