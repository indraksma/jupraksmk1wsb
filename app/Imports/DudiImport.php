<?php

namespace App\Imports;

use App\Models\Dudi;
use Maatwebsite\Excel\Concerns\ToModel;

class DudiImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dudi([
            'nama_dudi' => $row[0],
            'kab_kota' => $row[1],
            'alamat' => $row[2],
        ]);
    }
}
