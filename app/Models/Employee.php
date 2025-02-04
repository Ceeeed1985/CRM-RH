<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\Departement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function departement() {
        return $this->belongsTo(Departement::class);
    }

    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
