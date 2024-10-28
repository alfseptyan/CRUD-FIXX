@extends('components.layout')
@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Create Data</h4>

    <form action="{{ route('store') }}" method="POST">
        @csrf
        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter book title" required>
        </div>

        <!-- Author -->
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control" placeholder="Enter author's name" required>
        </div>

        <!-- Harga -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" placeholder="Enter book price" required>
        </div>

        <!-- Tanggal Terbit -->
        <div class="mb-3">
            <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
            <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" placeholder="yyyy/mm/dd">
        </div>

        <!-- Submit and Back Buttons -->
        <div class="mt-4 d-flex justify-content-between">
            <!-- Tombol Back -->
            <a href="{{'/buku'}}" class="btn btn-secondary">
                Back
            </a>
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">
                Create
            </button>
        </div>
    </form>
</div>
@if ($errors->any())
    <ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
@endsection