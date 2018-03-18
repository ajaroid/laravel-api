<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        $data = DB::table('rombels')->select('tahun_ajar', 'kelas_id')->groupBy('tahun_ajar', 'kelas_id')->get();
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

    public function store2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajar' => 'required',
            'kelas_id' => 'required',
            'semester' => 'required',
        ]);
        if ($validator->passes()) {
            if (!$request->has('siswa_ids')) {
                return ['sukses' => false, 'errors' => 'missing siswa ids'];
            }
            $newItems = collect($request->input('siswa_ids'))->map(function ($item) use ($request) {
                return [
                    'tahun_ajar' => $request['tahun_ajar'],
                    'kelas_id' => $request['kelas_id'],
                    'semester' => $request['semester'],
                    'siswa_id' => $item
                ];
            })->toArray();
            DB::table('rombels')->insert($newItems);
            return [
                'sukses' => true,
                'pesan' => 'Sukses'
            ];
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
        $data= Rombel::where('id', $id)->with('Siswa', 'Kelas')->first();
        return response()->json($data);
    }

    public function show2($tahun_ajar, $kelas_id)
    {
        $data = Rombel::where(['tahun_ajar' => $tahun_ajar, 'kelas_id' => $kelas_id])->with(['kelas', 'siswa'])->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = rombel::find($id);
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

    public function update2(Request $request, $tahun_ajar, $kelas_id)
    {
        Rombel::where(['tahun_ajar' => $tahun_ajar, 'kelas_id' => $kelas_id])->delete();

        $newItems = collect($request->input('siswa_ids'))->map(function ($item) use ($tahun_ajar, $kelas_id) {
            return [
                'tahun_ajar' => $tahun_ajar,
                'kelas_id' => $kelas_id,
                'semester' => 1,
                'siswa_id' => $item
            ];
        })->toArray();
        DB::table('rombels')->insert($newItems);
        return ['status' => true, 'pesan' => 'Sukses'];
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
        return response()->json(['sukses' => true]);
    }
}
