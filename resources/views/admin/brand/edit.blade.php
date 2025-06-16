@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands.index') }}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Brand Detail</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.brands.update', $brand) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $brand->id }}">
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand name" name="name" tabindex="0"
                            value="{{ $brand->name }}" aria-required="true" required=""
                            {{ isset($readonly) ? 'readonly' : '' }}>
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug" tabindex="0"
                            value="{{ $brand->slug }}" aria-required="true" required=""
                            {{ isset($readonly) ? 'readonly' : '' }}>
                    </fieldset>
                    @error('slug')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if (!@empty($brand->image))
                                <div class="item" id="imgpreview" style="display:block">
                                    <img src="{{ asset('storage/uploads/brands/' . $brand->image) }}" class="effect8"
                                        alt="Brand Image">
                                </div>
                            @else
                                <div class="item" id="imgpreview" style="display:none">
                                    <img src="" class="effect8" alt="No image">
                                </div>
                            @endif

                            @if (!isset($readonly))
                                <div id="upload-file" class="item up-load">
                                    <label class="uploadfile" for="myFile">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="body-text">Drop your images here or select <span class="tf-color">click
                                                to browse</span></span>
                                        <input type="file" id="myFile" name="image" accept="image/*">
                                    </label>
                                </div>
                            @endif
                        </div>
                    </fieldset>
                    @error('image')
                        <span class="alert alert-danger text-center">{{ $message }}</span>
                    @enderror

                    <div class="bot">
                        @if (!@isset($readonly))
                            <button class="tf-button w208" type="submit">Save</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@if (!isset($readonly))
    @push('scripts')
        <script>
            document.getElementById('myFile').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgPreview = document.getElementById('imgpreview');
                        imgPreview.style.display = 'block';
                        imgPreview.querySelector('img').src = e.target.result;
                        // document.getElementById('upload-file').style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endif
