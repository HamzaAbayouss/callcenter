<?php

namespace App\Repositories;

interface ObjetRepositoryInterface
{
    /**
     * Récupérer un objet par sa référence.
     *
     * @param string $reference
     * @return \App\Models\Objet|null
     */
    public function getObjetByReference(string $reference);
}
