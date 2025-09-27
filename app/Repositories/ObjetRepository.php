<?php

namespace App\Repositories;

use App\Models\Objet;

class ObjetRepository implements ObjetRepositoryInterface
{
    /**
     * Récupérer un objet à partir de sa référence unique.
     *
     *
     * @param string $reference La référence de l'objet
     * @return \App\Models\Objet|null
     */
    public function getObjetByReference(string $reference)
    {
        return Objet::where('reference', $reference)->first();
    }
}
