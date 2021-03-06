<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;  

use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = DB::table('dosen')->get();
        // foreach($result as $k => $v){
        //     $result[$k]->detail = 'localhost/api/getdosen/' . $v->id;
        //     $result[$k]->hapus = 'localhost/api/dosen/' . $v->id;
        // }
        return response($result);
        //
    }

        /**
     * @param String $idgit
     */
    function getById($nip)
    {
        return response(DB::table('dosen')->where('nip', $nip)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $dosen = [
            'nip' => Str::random(5),
            'nama_dosen' => $request->dosen,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];
        try {
            DB::table('dosen')->insert($dosen);
            return response(['message' => 'Berhasil menambahkan mata kuliah ' . $dosen['nama_dosen']]);
        } catch (\Throwable $th) {
            return response(['masage' => 'terjadi kesalahan', 'error' => $th], 500);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $nip)
    {
        $dosen = [];
        if (isset($request->dosen))
            $dosen['nama_dosen'] = $request->dosen;
        if (isset($request->jenis_kelamin))
            $dosen['jenis_kelamin'] = $request->jenis_kelamin;
        if (isset($request->alamat))
            $dosen['alamat'] = $request->alamat;
        try {
            DB::table('dosen')->where('nip', $nip)->update($dosen);
            return response(['message' => 'Berhasil Memperbarui dosen dengan nip ' . $nip]);
        } catch (\Throwable $th) {
            return response(['masage' => 'terjadi kesalahan', 'error' => $th], 500);
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nip)
    {
        try {
            DB::table('dosen')->where('nip', $nip)->delete();
            return response(['message' => 'Berhasil Menghapus   dengan nip ' . $nip]);
        } catch (\Throwable $th) {
            return response(['masage' => 'terjadi kesalahan', 'error' => $th], 500);
        }
        //
    }
}
