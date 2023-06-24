<?php

namespace App\Imports;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PetugasImport implements ToModel, WithBatchInserts, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = User::updateOrCreate(
            ['email' => $row['Email']],
            [
                'name' => $row['Nama'],
                'password' => Hash::make($row['Password']),
            ]
        );

        return new Petugas([
            'name' => $row['Nama'],
            'user_id' => $user->id,
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 1000; // Sesuaikan ukuran batch sesuai kebutuhan Anda
    }
}
