<!DOCTYPE html>
<html>
<head>
    <title>Tutorial Membuat CRUD Pada Laravel - www.malasngoding.com</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">www.malasngoding.com</h2>
        <h3 class="text-center">Data Pegawai</h3>

        <div class="text-right mb-3">
            <a href="/pegawai/tambah" class="btn btn-primary">+ Tambah Pegawai Baru</a>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <form action="/pegawai/cari" method="GET" class="form-inline">
                <input type="text" name="cari" class="form-control mr-2" placeholder="Cari Pegawai .." value="{{ old('cari') }}">
                <input type="submit" value="CARI" class="btn btn-secondary">
            </form>
        </div>


        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Umur</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawai as $p)
                <tr>
                    <td>{{ $p->pegawai_nama }}</td>
                    <td>{{ $p->pegawai_jabatan }}</td>
                    <td>{{ $p->pegawai_umur }}</td>
                    <td>{{ $p->pegawai_alamat }}</td>
                    <td>

                        @if ($p->deleted_at)
                            <span class="badge badge-danger">Dihapus</span>
                        @else
                            <span class="badge badge-success">Aktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="/pegawai/edit/{{ $p->pegawai_id }}" class="btn btn-warning btn-sm">Edit</a>
                        @if (!$p->deleted_at)
                            <a href="/pegawai/hapus/{{ $p->pegawai_id }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        @else
                            <form action="/pegawai/restore/{{ $p->pegawai_id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary btn-sm">Restore</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $pegawai->links() }}
        </div>
    </div>

    <!-- Tambahkan link ke Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
