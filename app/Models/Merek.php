<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merek extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the transports for the Merek
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transports(): HasMany
    {
        return $this->hasMany(Transport::class, 'merek_id', 'id');
    }
}
