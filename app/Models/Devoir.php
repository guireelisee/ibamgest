<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devoir extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * The surveillants that belong to the Devoir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function surveillants(): BelongsToMany
    {
        return $this->belongsToMany(Surveillant::class);
    }

    /**
     * Get the matiere that owns the Devoir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }

    /**
     * Get the professeur that owns the Devoir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professeur(): BelongsTo
    {
        return $this->belongsTo(Professeur::class);
    }

    /**
     * Get the filiere that owns the Devoir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function filiere(): BelongsTo
    {
        return $this->belongsTo(Filiere::class);
    }

    /**
     * Get the salle that owns the Devoir
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salle(): BelongsTo
    {
        return $this->belongsTo(Salle::class);
    }
}
