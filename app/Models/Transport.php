<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'license_plate',
        'size_passenger',
        'image',
        'merek_id',
    ];

    /**
     * Get all of the service for the Transport
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(): HasMany
    {
        return $this->hasMany(ServiceSchedule::class, 'transport_id', 'id');
    }

    /**
     * Get all of the order for the Transport
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(OrderTransport::class, 'transport_id', 'id');
    }

    /**
     * Get the merk that owns the Transport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merek(): BelongsTo
    {
        return $this->belongsTo(Merek::class, 'merek_id', 'id');
    }
}
