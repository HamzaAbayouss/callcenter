<?php

namespace App\Repositories;

use App\Models\Objet;

class ObjetRepository implements ObjetRepositoryInterface
{
    /**
     * Récupérer un objet par sa référence.
     *
     * @param string $reference
     * @return \App\Models\Objet|null
     */
    public function getObjetByReference(string $reference)
    {
        return Objet::where('reference', $reference)->first();
    }
}
