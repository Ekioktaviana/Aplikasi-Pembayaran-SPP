@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('siswa.update', $siswa->nisn) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="number" name="nisn" id="nisn" required min="1" class="form-control" value="{{ $siswa->nisn }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" name="nis" id="nis" required min="1" class="form-control" value="{{ $siswa->nis }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama_siswa">Nama</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" required class="form-control" value="{{ $siswa->nama_siswa }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        {{-- <input type="number" name="id_kelas" id="id_kelas" required class="form-control"> --}}
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option value="">--PILIH KELAS--</option>
                            @foreach ($kelas as $index=>$data)
                                <option value="{{ $index }}" @if ($index == $siswa->id_kelas)
                                    selected
                                @endif>{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="number" name="no_telepon" id="no_telepon" required min="1" class="form-control" value="{{ $siswa->no_telepon }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_spp">SPP</label>
                        {{-- <input type="number" name="id_spp" id="id_spp" required min="1" class="form-control"> --}}
                        <select name="id_spp" id="id_spp" class="form-control" required>
                            <option value="">--PILIH SPP--</option>
                            @foreach ($spp as $index=>$data)
                                <option value="{{ $index }}" @if ($index == $siswa->id_spp)
                                    selected
                                @endif>{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" name="alamat" id="alamat" required class="form-control">{{ $siswa->alamat }}</textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            <a href="{{ route('siswas') }}" class="btn btn-sm btn-primary">Kembali</a>
        </form>
    </div>
@endsection
