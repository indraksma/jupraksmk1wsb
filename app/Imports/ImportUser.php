<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    // public function startRow(): int
    // {
    //     return 2;
    // }

    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'nip' => $row[1],
            'identity' => $row[2],
            'email' => $row[3],
            'password' => Hash::make('Smkn1Wonosobo'),
        ]);
    }
}
