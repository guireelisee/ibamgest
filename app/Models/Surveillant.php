<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surveillant extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    /**
     * The devoirs that belong to the Surveillant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function devoirs(): BelongsToMany
    {
        return $this->belongsToMany(Devoir::class);
    }

}
