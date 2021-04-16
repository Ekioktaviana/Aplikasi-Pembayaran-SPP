@extends('layouts.app')

@section('app.js')
    <script src="{{ asset('js/app.js') }}" defer></script>    
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('spp.update', $spp->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" id="tahun" class="form-control" min="1" required value="{{ $spp->tahun }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" id="nominal" class="form-control" min="1" required value="{{ $spp->nominal }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
            <a href="{{ route('spps') }}" class="btn btn-primary btn-sm">Kembali</a>
        </form>
    </div>
@endsection
