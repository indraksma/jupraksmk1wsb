<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kelas_id = Kelas::where('nama_kelas', 'like', $row[3])->pluck('id');
        return new Siswa([
            'nama' => $row[0],
            'nis' => $row[1],
            'jk' => $row[2],
            'kelas_id' => $kelas_id,
        ]);
    }
}
