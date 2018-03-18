<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Kelas;
use Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Kelas::all();
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
            'nama' => 'required',
        ]);
        if ($validator->passes()) {
            $data = new Kelas();
            $data->nama = $request['nama'];
            $data->save();
            $pesan = 'Data Berhasil Disimpan';
            return response()->json([
                'sukses' => true,
                'pesan' => $pesan,
                'data' => $request->all()
            ]);
        } else {
            return response()->json([
                'sukses' => false,
                'errors' => $validator->errors()
            ]);
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
        $data= Kelas::find($id);
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
        $data= Kelas::find($id);
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
        $data = Kelas::find($id);
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
        if ($validator->passes()) {
            $data->nama = $request['nama'];
            $data->update();
            $pesan = 'Data Berhasil Diperbarui';
            return response()->json(['sukses' => true, 'pesan' => $pesan, 'data' => $request->all()]);
        } else {
            return response()->json(['sukses' => false,'errors' => $validator->errors()]);
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
        $data = Kelas::find($id);
        $data->delete();
        return response()->json(['sukses' => true]);
    }
}
