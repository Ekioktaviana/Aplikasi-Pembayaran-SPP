@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4><b>SISWA</b></h4>
                <hr>
            </div>
        </div>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm mb-4">Tambah Siswa</a>

        <table class="table table-sm table-hovered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nisn</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>SPP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $index=>$data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->nisn }}</td>
                        <td>{{ $data->nis }}</td>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->kompetensi_keahlian }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ $data->no_telepon }}</td>
                        <td>{{ $data->tahun }}</td>
                        <td>
                            <form action="{{ route('siswa.destroy', $data->nisn) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('siswa.edit', $data->nisn) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
