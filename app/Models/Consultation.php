<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['rdv_id', 'date_consultation', 'type_consultation', 'diagnostic'];

    public function rdv()
    {
        return $this->belongsTo(Rdv::class, 'rdv_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
   
    
    public function ordonnance()
    {
        return $this->hasMany(Ordonnance::class, 'consultation_id')->onDelete('cascade');
    }
    
}

