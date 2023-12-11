@extends('layouts.app')

@section('title', 'All Materials')

@push('style')
    <!-- CSS Libraries -->\
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Materi</h1>
                <div class="section-header-button">
                    <a href="{{ route('materi.create') }}" class="btn btn-primary">Add New</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Materi</a></div>
                    <div class="breadcrumb-item">All Materi</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">All Materi List</h2>
                <p class="section-lead">
                    You can manage all posts, such as editing, deleting and more.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body ta">
                                <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div>
                                <div class="float-right">
                                    <form method="GET" action="{{ route('materials.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="materi">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($materials as $material)
                                            <tr>
                                                <td>
                                                    {{ $material->id }}
                                                </td>
                                                <td>
                                                    {{ $material->title }}
                                                </td>
                                                <td>
                                                    {{ $material->content }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset('storage/' . $material->image) }}"
                                                        alt="{{ $material->title }}" width="100px">
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('materi.edit', $material->id) }}'
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        <form action="{{ route('materi.destroy', $material->id) }}"
                                                            method="POST" class="ml-2" data-confirm-delete="true">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $materials->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
