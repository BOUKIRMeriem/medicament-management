<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Medecin;

class DemandeRdv extends Model
{
    use HasFactory;
    protected $fillable = ["date", "heure","statut", "medecin_id","id_patient"];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}
