@extends('layouts.app')

@section('title', 'Edit Dress')

@section('nav-actions')
    <button
        type="button"
        class="pb-button pb-button-top home-button"
        onclick="window.location.href='{{ route('dresses.index') }}'">
        <span class="button-text">Dresses</span>
        <span class="pb-icon">
            <svg viewBox="0 0 20 20" aria-hidden="true" class="rotated-icon">
                <path d="M4.5 10h10M10.5 5l4.5 5-4.5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
            </svg>
        </span>
    </button>
@endsection

@section('hero')
<div class="pb-layout">
    <div class="pb-showcase">
        <div class="pb-copy-block">
            <h2>Preview your product instantly</h2>
            <p>Update the image and details, then save the latest version of your dress.</p>
        </div>

        <div class="pb-photo-shell product-upload-shell"
             style="text-align:center; padding:20px; border-radius:16px; cursor:pointer; display:flex; flex-direction:column; justify-content:center; align-items:center; min-height:150px;">

            <img
                id="product-preview"
                src="{{ old('remove_image') ? '' : (asset('storage/' . $dress->image_path) ?? '') }}"
                alt="Preview"
                style="max-width:100%; max-height:200px; {{ old('remove_image') || ! $dress->image_path ? 'display:none;' : 'display:block; margin-bottom:10px;' }}"
            >

            <label class="pb-upload-label"
                   style="cursor:pointer; display:flex; flex-direction:column; align-items:center; gap:8px; font-weight:500; color:#18311f;">
                <svg id="upload-icon"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24"
                     viewBox="0 0 24 24"
                     fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>

                <input type="file" name="image" id="product-image-input" form="product-form" accept="image/*" style="display:none;">
                <span id="upload-text">{{ $dress->image_path && ! old('remove_image') ? 'Change Image' : 'Click to Upload Image' }}</span>
            </label>

            @if ($dress->image_path)
                <label style="margin-top: 12px; display:flex; align-items:center; gap:8px; color:#6b7280; font-size:14px;">
                    <input type="checkbox" name="remove_image" value="1" form="product-form" @checked(old('remove_image'))>
                    Remove current image
                </label>
            @endif
        </div>
    </div>

    <div class="pb-panel">
        <div class="pb-panel-inner">
            <p class="pb-kicker">Update Product</p>
            <h2 class="pb-form-heading">Edit Your Dress</h2>
            <p class="pb-panel-copy">
                Update product details like name, size, category, and variants.
            </p>

            <form id="product-form"
                method="POST"
                action="{{ route('dresses.update', $dress) }}"
                enctype="multipart/form-data"
                class="pb-form-grid-single">
                @csrf
                @method('PUT')

                <label class="pb-field pb-field-full">
                    <span>Name<span aria-hidden="true">*</span></span>
                    <input type="text" name="name" placeholder="Enter product name" value="{{ old('name', $dress->name) }}">
                    @error('name')
                    <span class="pb-error">{{ $message }}</span>
                    @enderror
                </label>

                <label class="pb-field pb-field-full">
                    <span>Location<span aria-hidden="true">*</span></span>
                    <select name="location_id" class="searchable-select">
                        <option value="">Select Location</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" @selected(old('location_id', $dress->location_id) == $location->id)>{{ $location->name }}</option>
                        @endforeach
                    </select>
                    @error('location_id')
                    <span class="pb-error">{{ $message }}</span>
                    @enderror
                </label>

                <label class="pb-field pb-field-full">
                    <span>Category<span aria-hidden="true">*</span></span>
                    <select name="category_id" class="searchable-select">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $dress->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="pb-error">{{ $message }}</span>
                    @enderror
                </label>

                <label class="pb-field pb-field-full">
                    <span>Brand</span>
                    <input type="text" name="brand" placeholder="Enter brand name" value="{{ old('brand', $dress->brand) }}">
                    @error('brand')
                    <span class="pb-error">{{ $message }}</span>
                    @enderror
                </label>

                <div class="pb-field pb-field-full">
                    <span>Sizes</span>
                    <div class="size-chips">
                        @foreach(['XS','S','M','L','XL'] as $size)
                            <button type="button" class="chip {{ old('size', $dress->sizes) === $size ? 'active' : '' }}" onclick="toggleSize(this, '{{ $size }}')">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="size" id="sizes-input" value="{{ old('size', $dress->sizes) }}">
                    @error('size')
                    <span class="pb-error">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display:flex; gap:10px; margin-top:20px;">
                    <button type="submit" form="product-form" class="pb-button pb-button-top">
                        <span class="button-text">Update</span>
                    </button>
                    <button type="button"
                        class="pb-button pb-button-red"
                        onclick="window.history.back()">
                        <span class="button-text">Cancel</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('hero-footer')
    @include('layouts.footer')
@endsection
