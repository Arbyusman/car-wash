<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $rowIndex = 0;

    public function model(array $row)
    {
        $this->rowIndex++;

        return new User([
            'name' => $row['name'],
            'email' => str_replace(' ', '_', $row['name']).'@gmail.com',
            'identification_number' => $row['nim'],
            'password' => Hash::make($row['nim']),
            'role_id' => 3,
            'email_verified_at' => now(),
        ]);
    }
}
