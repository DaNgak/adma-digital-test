<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PricingOrder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'location_start_id',
        'location_finish_id',
        'distance',
        'price'
    ];

    /**
     * Get the location_start that owns the PricingOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location_start(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_start_id', 'id');
    }

    /**
     * Get the location_finish that owns the PricingOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location_finish(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_finish_id', 'id');
    }

    /**
     * Get all of the orders for the PricingOrder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(OrderTransport::class, 'pricing_order_id', 'id');
    }
}
