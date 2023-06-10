<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $fillable = ['medicament', 'date', 'dosage', 'nbr_fois', 'qte', 'consultation_id'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
