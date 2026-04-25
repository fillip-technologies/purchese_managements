<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {

        $role_id = Role::where('role',$row['role'])->select('id')->first();
        return new User([
            'full_name' => $row['full_name'] ?? null,
            'role_id'=>$role_id->id ?? null,
            'email' => $row['email'] ?? null,
            'password'=> Hash::make($row['password']) ?? null,
            'phone'=>$row['phone'] ?? null,
            'status'=>$row['status'] ?? null,
        ]);
    }
}
