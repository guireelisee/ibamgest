<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
