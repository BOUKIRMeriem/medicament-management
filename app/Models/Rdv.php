<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;

    protected $fillable = ["date", "heure", "duree", "commentaire", "patient_id", "medecin_id"];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
    
}
