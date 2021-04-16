@extends('layouts.app')

@section('app.js')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <h4><b>SPP</b></h4>
                <hr>
            </div>
        </div>
        <a href="{{ route('spp.create') }}" class="btn mb-4 btn-primary btn-sm">Tambah SPP</a>

        <table class="table table-sm table-hovered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($spp as $index=>$data)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $data->tahun }}</td>
                        <td>Rp. {{ number_format($data->nominal,2,',','.') }}</td>
                        <td>
                            <form action="{{ route('spp.destroy',$data->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('spp.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection