@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('kela.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                        <input type="text" name="kompetensi_keahlian" id="kompetensi_keahlian" class="form-control" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
            <a href="{{ route('kelas') }}" class="btn btn-sm btn-primary">Kembali</a>
        </form>
    </div>
@endsection
