<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Siswa;
use Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Siswa::orderBy('id', 'desc')->get();
        // $data->headers->set('Content-Type', 'application/json');
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'lahir_tempat' => 'required',
            'lahir_tanggal' => 'required',
            'alamat' => 'required',
        ]);
        if ($validator->passes()) {
            $data = new Siswa();
            $data->nis = $request['nis'];
            $data->nama = $request['nama'];
            $data->jenis_kelamin = $request['jenis_kelamin'];
            $data->lahir_tempat = $request['lahir_tempat'];
            $data->lahir_tanggal = $request['lahir_tanggal'];
            $data->alamat = $request['alamat'];
            $data->save();
            $pesan = 'Data Berhasil Disimpan';
            return response()->json(['sukses'=>true,'pesan'=>$pesan,'data'=>$request->all()]);
        } else {
            return response()->json(['sukses'=>false,'errors'=>$validator->errors()]);
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
        $data = Siswa::find($id);
        // $data['header'] =
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Siswa::find($id);
        return response()->json($data);
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
        $data = Siswa::find($id);
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'lahir_tempat' => 'required',
            'lahir_tanggal' => 'required',
            'alamat' => 'required',
        ]);
        if ($validator->passes()) {
            $data->nis = $request['nis'];
            $data->nama = $request['nama'];
            $data->jenis_kelamin = $request['jenis_kelamin'];
            $data->lahir_tempat = $request['lahir_tempat'];
            $data->lahir_tanggal = $request['lahir_tanggal'];
            $data->alamat = $request['alamat'];
            $data->update();
            $pesan = 'Data Berhasil Diperbarui';
            return response()->json(['sukses'=>true,'pesan'=>$pesan,'data'=>$request->all()]);
        } else {
            return response()->json(['sukses'=>false,'errors'=>$validator->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Siswa::find($id);
        $data->delete();
        return response()->json(['sukses' => true]);
    }
}
