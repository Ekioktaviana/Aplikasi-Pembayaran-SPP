<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\ViewPembayaran;
use App\Models\ViewSiswa;
use App\Models\Siswa;
use App\Models\Kela;
use App\Models\Spp;
use App\Exports\PembayaranExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pembayaran = ViewPembayaran::orderby('created_at','DESC')->get();
        if (Auth::user()->level == 'admin') {
            return view('pembayarans.index', compact('pembayaran'));
        }elseif (Auth::user()->level == 'petugas') {
            // $pembayaran = ViewPembayaran::orderby('created_at','DESC')->where('email', Auth::user()->email)->get();
            // dd($pembayaran);
            return view('pembayarans.indexPetugas', compact('pembayaran'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view_siswa = ViewSiswa::all();
        $siswa = Siswa::all();
        $spp = Spp::all();

        // dd($view_siswa);
        return view('pembayarans.create',compact('siswa','spp','view_siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $spp = Spp::find($siswa->id_spp);
        // dd($spp);

        $data_spp = Spp::where('id', $siswa->id_spp)->first();
        $kembalian = $request->jumlah_bayar - $data_spp->nominal;
        $number_format = number_format($kembalian,2,',','.');
        // dd($number_format);
        
        $transaksi = Pembayaran::where('nisn', $request->nisn)->get();
        
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        
        if(sizeof($transaksi) == 0){
            $urutan = 6;
            $tahun = substr($data_spp->tahun, 0 ,4);
            // dd($transaksi);
        }else{
            $a = count(end($transaksi));
            
            $akhir = $transaksi[$a-1];
            
            $b = array_search($akhir->bulan_dibayar, $months);
            
            if($b == 11){
                // dd($b);
                $urutan = 0;
                $tahun = $akhir->tahun_dibayar + 1;
            }else{
                $urutan = $b + 1;
                $tahun = $akhir->tahun_dibayar;
            }
        }

        if ($request->jumlah_bayar < $data_spp->nominal) {
            return redirect('pembayaran/create')->with('eror', 'Masukan Uang Yang Cukup!');
        }elseif ($request->jumlah_bayar >= $data_spp->nominal) {
            Pembayaran::create([
                'id_user' => Auth::user()->id,
                'nisn' => $request->nisn,
                'tanggal_bayar' => Carbon::now()->timezone('Asia/Jakarta'),
                'bulan_dibayar' => $months[$urutan],
                'tahun_dibayar' => $tahun,
                'id_spp' => $data_spp->id,
                'jumlah_bayar' => $data_spp->nominal
            ]); 

            return redirect('pembayarans')->with('sukses', 'Anda Mempunyai Kembalian senilai '.$number_format.'. Silahkan Ambil Uang Anda Kepada Pihak Sekolah');            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembayaran = ViewPembayaran::find($id);
        // dd($pembayaran);
        return view('pembayarans.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->first();
        // dd($pembayaran);
        $pembayaran->delete();

        return redirect('pembayarans');
    }

    public function getDataSpp($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->first();
        $spp = Spp::find($siswa->id_spp);
        $bulan_last = Pembayaran::where('nisn', $nisn)->latest()->first();
        // $last = array_key_last(end($bulan_last));
// 
        if($bulan_last == null){
            $bulan_last['bulan_dibayar'] = "(Belum Pernah Bayar SPP)";
            $bulan_last['tahun_dibayar'] = "(Belum Pernah Bayar SPP)";
        }

        $data = [
            'bulan' => $bulan_last['bulan_dibayar'],
            'tahun' => $bulan_last['tahun_dibayar'],
            'harga' => $spp->nominal,
            'id_spp' => $spp->id,
        ];

        return response()->json($data);
    }

    public function exportExcel()
    {
        return Excel::download(new PembayaranExport, 'Pembayaran.xlsx');
    }

    public function riwayatPembayaran()
    {
     
        $siswa = Auth::user()->email;

        $nis_siswa = substr($siswa,0, 7);
        // str
        
        if (Auth::user()->level == 'petugas') {
            $pembayaran = ViewPembayaran::orderby('created_at','DESC')->get();            
        }elseif (Auth::user()->level == 'admin') {
            $pembayaran = ViewPembayaran::orderby('created_at','DESC')->get();
        }elseif (Auth::user()->level == 'siswa') {
            $pembayaran = ViewPembayaran::where('nama_siswa', Auth::user()->name)->get();
            // dd($nis_siswa);
        }
        return view('laporans.index', compact('pembayaran'));
    }
}
