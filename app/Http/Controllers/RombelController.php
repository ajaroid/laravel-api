<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rombel;
use Validator;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['rombel'] = Rombel::with('Siswa','Kelas')->get();
      return response()->json($data);
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
      $validator = Validator::make($request->all(), [
        'tahun_ajar' => 'required',
        'kelas_id' => 'required',
        'siswa_id' => 'required',
        'semester' => 'required',
       ]);
       if ($validator->passes()) {
         $data = new Rombel();
         $data->tahun_ajar = $request['tahun_ajar'];
         $data->semester = $request['semester'];
         $data->kelas_id = $request['kelas_id'];
         $data->siswa_id = $request['siswa_id'];
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
      $data['rombel'] = Rombel::find($id);
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
      $data['rombel'] = rombel::find($id);
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
      $data = Rombel::find($id);
      $validator = Validator::make($request->all(), [
        'tahun_ajar' => 'required',
        'kelas_id' => 'required',
        'siswa_id' => 'required',
        'semester' => 'required',
       ]);
       if ($validator->passes()) {
         $data->tahun_ajar = $request['tahun_ajar'];
         $data->semester = $request['semester'];
         $data->kelas_id = $request['kelas_id'];
         $data->siswa_id = $request['siswa_id'];
         $data->save();
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
      $data = Rombel::find($id);
      $data->delete();
      return response()->json(['sukses'=>true]);
    }
}
