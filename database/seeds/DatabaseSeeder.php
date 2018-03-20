<?php

use Illuminate\Database\Seeder;
use App\Siswa;
use App\Kelas;
use App\Rombel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Kelas::create([
            'nama' => '1A'
        ]);
        Kelas::create([
            'nama' => '1B'
        ]);
        Kelas::create([
            'nama' => '1C'
        ]);
        Kelas::create([
            'nama' => '1D'
        ]);
        Kelas::create([
            'nama' => '2 Bahasa'
        ]);
        Kelas::create([
            'nama' => '2 IPS'
        ]);
        Kelas::create([
            'nama' => '2 IPA'
        ]);
        Kelas::create([
            'nama' => '3 Bahasa'
        ]);
        Kelas::create([
            'nama' => '3 IPS'
        ]);
        Kelas::create([
            'nama' => '3 IPA'
        ]);

        Siswa::create([
            'nis' => '1234',
            'nama' => 'johny',
            'jenis_kelamin' => 1,
            'lahir_tempat' => 'klaten',
            'lahir_tanggal' => '1994-06-06',
            'alamat' => 'Jl Pemuda'
        ]);
        Siswa::create([
            'nis' => '1235',
            'nama' => 'Jean',
            'jenis_kelamin' => 0,
            'lahir_tempat' => 'klaten',
            'lahir_tanggal' => '1994-06-07',
            'alamat' => 'Jl Pemuda'
        ]);
        Siswa::create([
            'nis' => '1236',
            'nama' => 'Juan',
            'jenis_kelamin' => 1,
            'lahir_tempat' => 'klaten',
            'lahir_tanggal' => '1995-08-07',
            'alamat' => 'Jl Pemuda'
        ]);
        Siswa::create([
            'nis' => '1237',
            'nama' => 'Jojo',
            'jenis_kelamin' => 1,
            'lahir_tempat' => 'klaten',
            'lahir_tanggal' => '1995-09-07',
            'alamat' => 'Jl Pemuda'
        ]);
        Siswa::create([
            'nis' => '1238',
            'nama' => 'Jejen',
            'jenis_kelamin' => 0,
            'lahir_tempat' => 'klaten',
            'lahir_tanggal' => '1995-09-07',
            'alamat' => 'Jl Pemuda'
        ]);
        Siswa::create([
            'nis' => '1239',
            'nama' => 'Juji',
            'jenis_kelamin' => 1,
            'lahir_tempat' => 'klaten',
            'lahir_tanggal' => '1995-09-07',
            'alamat' => 'Jl Pemuda'
        ]);

        Rombel::create([
            'tahun_ajar' => 2018,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 1
        ]);
        Rombel::create([
            'tahun_ajar' => 2018,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 2
        ]);
        Rombel::create([
            'tahun_ajar' => 2018,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 3
        ]);
        Rombel::create([
            'tahun_ajar' => 2018,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 4
        ]);

        Rombel::create([
            'tahun_ajar' => 2019,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 1
        ]);
        Rombel::create([
            'tahun_ajar' => 2019,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 2
        ]);
        Rombel::create([
            'tahun_ajar' => 2019,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 3
        ]);
        Rombel::create([
            'tahun_ajar' => 2019,
            'semester' => 1,
            'kelas_id' => 1,
            'siswa_id' => 4
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
