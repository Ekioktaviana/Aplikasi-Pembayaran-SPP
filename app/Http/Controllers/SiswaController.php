<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kela;
use App\Models\Spp;
use App\Models\ViewSiswa;
use App\Models\ViewPembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = ViewSiswa::orderby('created_at','DESC')->get();

        return view('siswas.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kela::pluck('nama_kelas', 'id');
        $spp = Spp::pluck('tahun', 'id');
        return view('siswas.create', compact('kelas','spp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'id_spp' => $request->id_spp,
        ]);

        User::create([
            'name' => $request->nama_siswa,
            'level' => 'siswa',
            'email' => $request->nis.'@gmail.com',
            'password' => Hash::make($request->nis),
        ]);

        return redirect('siswas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $kelas = Kela::pluck('nama_kelas', 'id');
        $spp = Spp::pluck('tahun', 'id');
        return view('siswas.edit', compact('siswa','kelas','spp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Siswa $id)
    {
        // dd($id);
        $id->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'id_spp' => $request->id_spp,
        ]);

        $user = User::where('email' , $id->nis.'@gmail.com')->first();
        // dd($user);
        $user->update([
            'name' => $request->nama_siswa,
            'level' => 'siswa',
            'email' => $request->nis.'@gmail.com',
            'password' => Hash::make($request->nis),
        ]);

        return redirect('siswas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $id)
    {
        $id->delete();

        return redirect('siswas');
    }
}
