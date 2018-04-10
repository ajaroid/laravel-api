<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rombel;
use App\Kelas;
use App\Siswa;
use Validator;
use DB;
class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('rombels')
            ->select('tahun_ajar', 'kelas_id', 'kelas.nama as kelas_nama')
            ->join('kelas', 'rombels.kelas_id', '=', 'kelas.id')
            ->groupBy('tahun_ajar', 'kelas_id')
            ->orderBy('tahun_ajar', 'desc')
            ->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajar' => 'required',
            'kelas_id' => 'required',
        ]);
        if ($validator->passes()) {
            if (!$request->has('siswa_ids')) {
                return ['sukses' => false, 'errors' => 'missing siswa ids'];
            }
            $existing = Rombel::where([
                'tahun_ajar' => $request['tahun_ajar'],
                'kelas_id' => $request['kelas_id'],
            ])->get();
            if (!$existing->isEmpty()) {
                return [
                    'sukses' => false,
                    'errors' => 'sudah ada rombongan belajar untuk tahun ' . $request['tahun_ajar'] . ' kelas id ' . $request['kelas_id']
                ];
            }
            $newItems = collect($request->input('siswa_ids'))->map(function ($item) use ($request) {
                return [
                    'tahun_ajar' => $request['tahun_ajar'],
                    'kelas_id' => $request['kelas_id'],
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

    public function show($tahun_ajar, $kelas_id)
    {
        $kelas = Kelas::find($kelas_id);
        $siswaMembers = Rombel::where([
            'tahun_ajar' => $tahun_ajar,
            'kelas_id' => $kelas_id,
        ])->with(['kelas', 'siswa'])
        ->get()
        ->map(function ($item) {
            return $item['siswa'];
        });
        $siswaIds = $siswaMembers->map(function ($item) {
            return $item['id'];
        });
        return [
            'tahun_ajar' => $tahun_ajar,
            'kelas' => $kelas,
            'siswa_members' => $siswaMembers,
            'siswa_ids' => $siswaIds
        ];
    }

    public function update(Request $request, $tahun_ajar, $kelas_id)
    {
        $validator = Validator::make($request->all(), [
            'tahun_ajar' => 'required',
            'kelas_id' => 'required',
        ]);
        if ($validator->passes()) {
            if (!$request->has('siswa_ids')) {
                return ['sukses' => false, 'errors' => 'missing siswa ids'];
            }

            Rombel::where(['tahun_ajar' => $tahun_ajar, 'kelas_id' => $kelas_id])->delete();

            $newItems = collect($request->input('siswa_ids'))->map(function ($item) use ($tahun_ajar, $kelas_id) {
                return [
                    'tahun_ajar' => $tahun_ajar,
                    'kelas_id' => $kelas_id,
                    'siswa_id' => $item
                ];
            })->toArray();
            DB::table('rombels')->insert($newItems);
            return ['sukses' => true, 'pesan' => 'Sukses'];
        } else {
            return [
                'sukses' => false,
                'errors' => $validator->errors()
            ];
        }
    }

    public function destroy($tahun_ajar, $kelas_id)
    {
        Rombel::where(['tahun_ajar' => $tahun_ajar, 'kelas_id' => $kelas_id])->delete();
        return [
            'sukses' => true,
            'pesan' => 'Sukses'
        ];
    }

}
