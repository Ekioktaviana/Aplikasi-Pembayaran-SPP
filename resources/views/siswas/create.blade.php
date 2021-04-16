@extends('layouts.app')

@section('app.js')
    {{-- <script src="{{ asset('js/app.js') }}" defer></script>     --}}
    <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

    <!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    
    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('siswa.store') }}" method="post">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="number" name="nisn" id="nisn" required min="1" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="number" name="nis" id="nis" required min="1" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nama_siswa">Nama</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" required class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        {{-- <input type="number" name="id_kelas" id="id_kelas" required class="form-control"> --}}
                        <select name="id_kelas" id="id_kelas" class="form-control" required>
                            <option value="">--PILIH KELAS--</option>
                            @foreach ($kelas as $index=>$data)
                                <option value="{{ $index }}">{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="number" name="no_telepon" id="no_telepon" required min="1" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_spp">SPP</label>
                        {{-- <input type="number" name="id_spp" id="id_spp" required min="1" class="form-control"> --}}
                        <select name="id_spp" id="id_spp" class="form-control" required>
                            <option value="">--PILIH SPP--</option>
                            @foreach ($spp as $index=>$data)
                                <option value="{{ $index }}">{{ $data }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" name="alamat" id="alamat" required class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            <a href="{{ route('siswas') }}" class="btn btn-sm btn-primary">Kembali</a>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#id_kelas').select2();
            $('#id_spp').select2();
        })
    </script>
@endsection
