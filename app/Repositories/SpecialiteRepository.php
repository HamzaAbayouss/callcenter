<?php
namespace App\Repositories;

use App\Models\Specialite;

class SpecialiteRepository implements SpecialiteRepositoryInterface {

    public function all() {
        return Specialite::all();
    }

    public function find($id) {
        return Specialite::findOrFail($id);
    }

    public function create(array $data) {
        return Specialite::create($data);
    }

}
