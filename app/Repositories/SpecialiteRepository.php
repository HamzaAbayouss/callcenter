<?php

namespace App\Repositories;

use App\Models\Specialite;

class SpecialiteRepository implements SpecialiteRepositoryInterface
{
    /**
     * Récupère toutes les spécialités
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Specialite::all();
    }

    /**
     * Trouve une spécialité par son ID
     *
     * Lève une exception si la spécialité n'existe pas.
     *
     * @param int $id
     * @return Specialite
     */
    public function find($id)
    {
        return Specialite::findOrFail($id);
    }

    /**
     * Crée une nouvelle spécialité avec les données fournies
     *
     * @param array $data
     * @return Specialite
     */
    public function create(array $data)
    {
        return Specialite::create($data);
    }
}
