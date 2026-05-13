<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_amount', 'status', 'payment_status', 'shipping_address',
        'city', 'state', 'postal_code', 'country',
        'guest_email', 'guest_firstname', 'guest_lastname', 'guest_phone',
    ];

    /**
     * Get full formatted shipping address.
     */
    public function getFullAddress(): string
    {
        $parts = array_filter([
            $this->shipping_address,
            $this->city,
            $this->state,
            $this->postal_code,
            $this->country,
        ]);

        return implode(', ', $parts);
    }

    /**
     * Check if this order was placed by a guest.
     */
    public function isGuest(): bool
    {
        return is_null($this->user_id);
    }

    /**
     * Get the customer name (works for both guests and registered users).
     */
    public function getCustomerName(): string
    {
        if ($this->user) {
            return $this->user->firstname . ' ' . $this->user->lastname;
        }

        return ($this->guest_firstname ?? '') . ' ' . ($this->guest_lastname ?? '');
    }

    /**
     * Get the customer email (works for both guests and registered users).
     */
    public function getCustomerEmail(): ?string
    {
        return $this->user?->email ?? $this->guest_email;
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function couponUsages()
    {
        return $this->hasMany(CouponUsage::class);
    }
}
