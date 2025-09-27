<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'client',
        'objet_id',
        'description',
        'status',
        'user_id',
    ];

    public function objet()
    {
        return $this->belongsTo(Objet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
