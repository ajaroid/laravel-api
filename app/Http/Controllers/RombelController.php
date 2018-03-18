<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rombel;
use App\Kelas;
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

    public function store(Request $request)
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

    public function show($tahun_ajar, $kelas_id, $semester)
    {
        $kelas = Kelas::find($kelas_id);
        $siswa_members = Rombel::where([
            'tahun_ajar' => $tahun_ajar,
            'kelas_id' => $kelas_id,
            'semester' => $semester
        ])->with(['kelas', 'siswa'])
        ->get()
        ->map(function ($item) {
            return $item['siswa'];
        });
        return [
            'tahun_ajar' => $tahun_ajar,
            'kelas' => $kelas,
            'semester' => $semester,
            'siswa_members' => $siswa_members
        ];
    }

    public function update(Request $request, $tahun_ajar, $kelas_id, $semester)
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

            Rombel::where(['tahun_ajar' => $tahun_ajar, 'kelas_id' => $kelas_id, 'semester' => $semester])->delete();

            $newItems = collect($request->input('siswa_ids'))->map(function ($item) use ($tahun_ajar, $kelas_id, $semester) {
                return [
                    'tahun_ajar' => $tahun_ajar,
                    'kelas_id' => $kelas_id,
                    'semester' => $semester,
                    'siswa_id' => $item
                ];
            })->toArray();
            DB::table('rombels')->insert($newItems);
            return ['status' => true, 'pesan' => 'Sukses'];
        } else {
            return [
                'sukses' => false,
                'errors' => $validator->errors()
            ];
        }
    }

    public function destroy($tahun_ajar, $kelas_id, $semester)
    {
        Rombel::where(['tahun_ajar' => $tahun_ajar, 'kelas_id' => $kelas_id, 'semester' => $semester])->delete();
        return [
            'sukses' => true,
            'pesan' => 'Sukses'
        ];
    }

}
