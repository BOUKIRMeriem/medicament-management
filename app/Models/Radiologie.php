<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiologie extends Model
{
    use HasFactory;
    protected $fillable = ['special_instructions','date','consultation_id'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
