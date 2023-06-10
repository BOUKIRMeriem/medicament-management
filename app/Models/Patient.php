<?php
namespace App\Models;

use App\Models\Rdv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['cin', 'nom', 'prenom', 'date_Naissance', 'adresse', 'telephone', 'adresse_Email', 'sexe','mutuelle'];

     public function classe()
    {
        return $this->hasOne(Classe::class);
    }
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
    use Notifiable;

    // ...

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}

