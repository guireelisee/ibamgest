<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salle extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * Get all of the fiches for the Salle
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fiches(): HasMany
    {
        return $this->hasMany(Fiche::class);
    }
}
