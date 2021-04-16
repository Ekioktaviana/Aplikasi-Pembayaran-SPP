@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container"  id="print" onclick="print()">
        <div class="card">
            <div class="card-header" style="background-color: rgb(21, 96, 162)">
                <h4 class="text-center"><b> KWITANSI PEMBAYARAN SPP</b></h4>
                <h5 class="text-center"><b> SMK WIKRAMA 1 GARUT </b></h5>
                <p class="text-right">No. {{ $pembayaran->id }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">

                        <label for="">NIS :</label>
                        <label for="">{{ $pembayaran->nis }}</label>
                        
                        <br>
                        <label for="">NAMA :</label>
                        <label for="">{{ $pembayaran->nama_siswa }}</label>
                        <br>
                        
                        <label for="">KELAS :</label>
                        <label for="">{{ $pembayaran->nama_kelas }}</label>
                        
                        <br>
                        <label for="">KOMPETENSI KEAHLIAN :</label>
                        <label for="">{{ $pembayaran->kompetensi_keahlian }}</label>
                    </div>
                    <div class="col-6">
                        <label for="">ALAMAT :</label>
                        <label for="">{{ $pembayaran->alamat }}</label>
                        <br>

                        <label for="">NO TELEPON :</label>
                        <label for="">{{ $pembayaran->no_telepon }}</label>
                        
                        <br>
                    </div>
                </div>
            </div>
            <hr>
            <hr>
            <div class="card-body">
                
                <label for="">BAYAR BULAN :</label>
                <label for="">{{ $pembayaran->bulan_dibayar }}</label>
                <br>
                
                <label for="">TAHUN DIBAYAR :</label>
                <label for="">{{ $pembayaran->tahun_dibayar }}</label>
                <br>
                
                <label for="">TANGGAL BAYAR :</label>
                <label for="">{{ $pembayaran->tanggal_bayar }}</label>
                <br>

                <label for="">JUMLAH BAYAR :</label>
                <label for="">Rp. {{ number_format($pembayaran->jumlah_bayar,2,',','.') }}</label>
            </div>
        </div>
        <br>
        {{-- <div class="card">
            
        </div> --}}
    </div>

    <script>
        $('#print').function print() {
            window.print();
        }
    </script>
@endsection
