<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Récupère tous les utilisateurs avec le rôle "commercial"
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return User::where('role', 'commercial')->get();
    }

    /**
     * Trouve un utilisateur par son ID avec le rôle "commercial"
     *
     * Lève une exception si l'utilisateur n'existe pas.
     *
     * @param int $id
     * @return User
     */
    public function find($id)
    {
        return User::where('role', 'commercial')->findOrFail($id);
    }

    /**
     * Crée un nouvel utilisateur avec le rôle "commercial"
     *
     * Le mot de passe par défaut est '12345678', hashé avec bcrypt.
     *
     * @param array $data
     * @return User
     */
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
