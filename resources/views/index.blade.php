@extends('components.layout')
@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
<div class="container mt-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @else
                        <div class="alert alert-success">
                            You are logged in!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Tombol Create -->
    @auth
    <div class="mb-3">
        <a href="{{ route('create') }}" class="btn btn-primary">
            Create
        </a>
    </div>
    @endauth

    @if (@session('status'))
        <script>
            alert('{{ session('status') }}');
        </script>
    @endif

    <table  class="datatable align-middle table table-light table-striped text-center">
        <thead class="thead-light">
            <tr class="table-primary">
                <th scope="col">NO</th>
                <th scope="col">ID</th>
                <th scope="col">Judul</th>
                <th scope="col">Penulis</th>
                <th scope="col">Harga</th>
                <th scope="col">Tanggal Terbit</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Looping data -->
            @foreach ($books as $index => $book)
            <tr>
                <th scope="row">{{ $index + 1 }}</th>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ "Rp" . number_format($book->harga, 2, ',', '.') }}</td>
                <td>{{ $book->tanggal_terbit }}</td>

                @if (Auth::User())
                <td>
                    <!-- Form untuk Delete -->
                    <form action="{{ route('destroy', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <!-- Tombol Edit -->
                    <a href="{{ route('edit', $book->id) }}" class="btn btn-info btn-sm">Edit</a>
                </td>
                @else
                <td></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bagian untuk menampilkan total buku dan total harga -->
    <div class="mt-3 p-3 bg-light">
        <p class="h5">Total Buku: {{ $totalBooks }}</p>
        <p class="h5">Total Harga Buku: Rp{{ number_format($totalHarga, 2, ',', '.') }}</p>
    </div>
</div>

<!-- JQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script>
    new DataTable('.datatable');
</script>
@endsection
