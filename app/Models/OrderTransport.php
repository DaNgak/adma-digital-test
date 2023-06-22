<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTransport extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'transport_id',
        'user_id',
        'total_passanger',
        'pickup_location',
        'date_pickup',
        'status',
        'location_start_id',
        'location_finish_id',
        'pricing_order_id'
    ];

    /**
     * Get the transport that owns the OrderTransport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transport::class, 'transport_id', 'id');
    }

    /**
     * Get the user that owns the OrderTransport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the pricing_order that owns the OrderTransport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pricing_order(): BelongsTo
    {
        return $this->belongsTo(PricingOrder::class, 'pricing_order_id', 'id');
    }

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
}
