<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function all()
    {
        return User::where('role', 'commercial')->get();
    }

    public function find($id)
    {
        return User::where('role', 'commercial')->findOrFail($id);
    }

    public function create(array $data)
    {
        $data['role'] = 'commercial';
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'specialite_id' => $data['specialite_id'],
            'role' => $data['role'],
            'password' => bcrypt('12345678'),
        ]);
    }
}
