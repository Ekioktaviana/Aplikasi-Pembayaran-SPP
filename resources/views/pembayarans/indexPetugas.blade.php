@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-primary mb-4">Tambah Pembayaran</a>
            </div>
            <div class="col-6 text-right" >
                <a href="{{ route('pembayaran.export') }}" class="btn btn-sm btn-success mb-4 ">Download Excel</a>
            </div>
        </div>

        <table class="table table-sm table-hovered">
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
                    <th>Aksi</th>
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
                        <td>
                            {{-- <form action="{{ route('pembayaran.destroy', $data->id) }}" method="post"> --}}
                                {{-- @csrf --}}
                                {{-- @method('DELETE') --}}

                                {{-- <a href="{{ route('pembayaran.edit', $data->nisn) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                                <a href="{{ route('pembayaran.show', $data->id) }}" class="btn btn-sm btn-info">Show</a>
                                {{-- <button type="submit" class="btn btn-sm btn-danger">Hapus</button> --}}
                            {{-- </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
