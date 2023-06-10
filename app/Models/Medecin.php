<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RDV;
class Medecin extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "prenom", "email", "telephone", "specialite"];

    public function classe()
    {
        return $this->hasOne(Classe::class);
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
   
    public function consultations()
    {
        return $this->hasManyThrough(Consultation::class, RDV::class, 'medecin_id', 'rdv_id');
    }
    

    
}
