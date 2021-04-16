@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4><b>KELAS</b></h4>
                <hr>
            </div>
        </div>
        <a href="{{ route('kela.create') }}" class="btn btn-sm btn-primary mb-4">Tambah Kelas</a>

        <table class="table table-sm table-hovered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $index=>$data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->kompetensi_keahlian }}</td>
                        <td>
                            <form action="{{ route('kela.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('kela.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
