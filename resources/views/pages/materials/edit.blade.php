@extends('layouts.app')

@section('title', 'Edit Materi')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Materi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Edit Materi</div>
                </div>
            </div>

            <div class="section-body">

                <div class="card">
                    <form action="{{ route('materi.update', $material) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text"
                                    class="form-control @error('title')
                                is-invalid
                                    @enderror"
                                    name="title" value="{{ $material->title }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <input type="text" value="{{ $material->content }}"
                                    class="form-control @error('content')
                                is-invalid
                            @enderror"
                                    name="content">
                                @error('content')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>

                                <div>
                                    <img class="img-thumbnail" src="{{ asset('storage/' . $material->image) }}"
                                        style="width: 50%" alt="Material Image">
                                </div>
                                <div class="mt-2">
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
