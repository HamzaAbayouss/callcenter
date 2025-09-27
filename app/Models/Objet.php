<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    use HasFactory;

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

    public function tickets()
    {
        return $this->hasMany(CallTicket::class);
    }
}
