<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'province',
    ];

    /**
     * Get all of the location_start for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pricing_location_start(): HasMany
    {
        return $this->hasMany(PricingOrder::class, 'location_start_id', 'id');
    }

    /**
     * Get all of the pricing_location_finish for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pricing_location_finish(): HasMany
    {
        return $this->hasMany(PricingOrder::class, 'location_finish_id', 'id');
    }

        /**
     * Get all of the location_start for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_location_start(): HasMany
    {
        return $this->hasMany(OrderTransport::class, 'location_start_id', 'id');
    }

    /**
     * Get all of the pricing_location_finish for the Location
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_location_finish(): HasMany
    {
        return $this->hasMany(OrderTransport::class, 'location_finish_id', 'id');
    }
}
