@extends('layouts.app')

@section('app.js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4><b>RIWAYAT PEMBAYARAN</b></h4>
                <hr>
            </div>
            {{-- <hr> --}}
        </div>
        <br>

        <table id="tabel" class="table table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Petugas</th>
                    <th>NIS</th>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Tahun SPP</th>
                    <th>Nominal SPP</th>
                    <th>Tanggal Bayar</th>
                    <th>Bulan Dibayar</th>
                    <th>Tahun Dibayar</th>
                    <th>Jumlah Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $index=>$data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->nis }}</td>
                        <td>{{ $data->nama_siswa }}</td>
                        <td>{{ $data->nama_kelas }}</td>
                        <td>{{ $data->tahun }}</td>
                        <td>Rp. {{ number_format($data->nominal,2,',','.') }}</td>
                        <td>{{ $data->tanggal_bayar }}</td>
                        <td>{{ $data->bulan_dibayar }}</td>
                        <td>{{ $data->tahun_dibayar }}</td>
                        <td>Rp. {{ number_format($data->jumlah_bayar,2,',','.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabel').dataTable();
        })
    </script>
@endsection
