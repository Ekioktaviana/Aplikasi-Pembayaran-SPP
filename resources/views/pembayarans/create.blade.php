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
        <form action="{{ route('pembayaran.store') }}" method="post">
            @if ($message = Session::get('eror'))
                <div  class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <select onchange="getDataSpp()" name="nisn" id="nisn"  required class="form-control" >
                            <option value="">--PILIH SISWA</option>
                            {{-- @foreach ($view_siswa as $item) --}}
                            @foreach ($view_siswa as $index=>$data)
                                    <option value="{{ $data->nisn }}">{{ $data->nisn }} : {{ $data->nama_siswa }}</option>
                                {{-- @endforeach --}}
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar</label>
                        <input type="number" name="jumlah_bayar" id="jumlah_bayar" min="1" required class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nisn">Nominal SPP</label>
                        <input type="text" name="harga" id="harga" readonly class="form-control">  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan">Bulan Terakhir Bayar</label>
                        <input type="text" readonly id="bulan" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun">Tahun Terakhir Bayar</label>
                        <input type="text" readonly id="tahun" class="form-control">
                    </div>
                </div>

                <input type="text" name="id_spp" id="id_spp" hidden readonly>


            </div>
            
            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
            <a href="{{ route('pembayarans') }}" class="btn btn-sm btn-primary">Kembali</a>
        </form>
    </div>

    <script>
        function getDataSpp() {
            var nisn = $('#nisn').val();
            console.log(nisn);

            $.ajax({
                url: '/pembayaran/get-data' + '/' + nisn,
                type: 'GET',
                success: function(data) {
                    console.log(data)
                    $('#harga').val("Rp. "+ data['harga']);
                    // $('#id_spp').val(data['id_spp']);
                    $('#bulan').val(data['bulan']);
                    $('#tahun').val(data['tahun']);
                }
            })
        }

    </script>

    <script>
        $(document).ready(function() {
            $('#nisn').select2();
        });
    </script>

















































<script>
    $(document).ready(function() {
       $('#nisn').select2(); 
    });

    function getDataSpp() {
        var nisn = $('#nisn').val();
        console.log(nisn);

        $.ajax({
            url: 'pembayaran/get-data' + '/' + nisn,
            type: 'GET',
            success: function(data) {
                $('#harga').val(data['harga']);
            }
        })
    }
</script>
@endsection
