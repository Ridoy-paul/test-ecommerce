@extends('admin.layouts.master')
@section('title', 'Update Business Profile')
@section('content')
<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Update Business Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Details</h5>
                </div>
                <div class="card-body text-center">
                    @if (!empty($user->image))
                        <img src="{{ asset('images/'.$user->image) }}" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    @else
                        <img src="{{ asset('admin_resources/images/avatars/profile.jpg') }}" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    @endif
                    <h2 class="mb-0">{{ $user->name }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="hidden" name="userId" value="{{ encrypt($user->id) }}">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" required name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="disctrict_code" class="form-label">District</label>
                            <select name="disctrict_code" class="form-control" id="disctrict_code">
                                @foreach($districtList as $item)
                                    <option value="{{ $item->code }}" {{ $user->disctrict_code == $item->code ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('disctrict_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $user->adress) }}</textarea>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Seller Photo</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if (!empty($user->image))
                                <img width="50px" src="{{ asset('images/'.$user->image) }}" />
                            @endif
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
