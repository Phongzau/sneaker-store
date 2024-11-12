@extends('layouts.admin')

@section('title')
    Sneaker Store | Banners Create
@endsection

@section('section')
    <!-- Main Content -->

    <section class="section">
        <div class="section-header">
            <h1>Banners</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card bg-light">
                        <div class="card-header bg-white">
                            <h4>Create Banners</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label for="">Url</label>
                                                    <input type="text" name="url" value="{{ old('url') }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <input type="text" name="description" value="{{ old('description') }}"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputState">Status</label>
                                                    <select id="inputState" name="status" class="form-control">
                                                        <option value="" hidden>--Select--</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Create</button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="customField">Image Main</label>
                                                    <!-- Hình ảnh đại diện -->
                                                    <div class="image-placeholder"
                                                        style="width: 100%; height: 300px; background-color: #e9ecef; display: flex; justify-content: center; align-items: center;">
                                                        <img id="previewImage"
                                                            src="{{ asset('admin/assets/img/news/img01.jpg') }}"
                                                            alt="Ảnh đại diện" style="max-width: 100%; max-height: 100%;" />
                                                    </div>

                                                    <!-- Nút Upload và Select -->
                                                    <div class="d-flex justify-content-around mt-3">
                                                        <input type="file" id="imageUpload" name="image" class="d-none"
                                                            accept="image/*">
                                                        <button class="btn btn-dark" id="uploadBtn">Upload
                                                            file...</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="imageUpload">Image</label>
                                    <input type="file" name="image" id="imageUpload" class="form-control" accept="image/*">
                                </div>

                                <!-- Thẻ img để hiển thị ảnh đã chọn -->
                                <div class="form-group">
                                    <img id="imageDisplay" src="" alt="Image preview" style="max-width: 300px; display: none;">
                                </div>

                                <div class="form-group">
                                    <label for="">Url</label>
                                    <input type="text" name="url" value="{{ old('url') }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" name="description" value="{{ old('description') }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option value="" hidden>--Select--</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Create</button> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#uploadBtn').on('click', function(event) {
                event.preventDefault(); // Ngăn việc submit form
                $('#imageUpload').click();
            });

            $('#imageUpload').on('change', function() {
                const files = $(this)[0].files;
                if (files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#previewImage').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                } else {
                    console.log("No file selected.");
                }
            })
        })
    </script>
@endpush
