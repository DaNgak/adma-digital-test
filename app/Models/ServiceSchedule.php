<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'service_schedule_date',
        'kilometer',
        'price',
        'description',
        'transport_id',
    ];

    /**
     * Get the transport that owns the ServiceSchedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transport::class, 'transport_id', 'id');
    }
}
