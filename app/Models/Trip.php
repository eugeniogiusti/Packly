<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'destination',
        'departure_date',
        'return_date',
        'type',
        'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date'    => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function packingItems()
    {
        return $this->hasMany(PackingItem::class)->orderBy('order');
    }

    public function getPackedCountAttribute(): int
    {
        return $this->packingItems()->where('packed', true)->count();
    }

    public function getTotalCountAttribute(): int
    {
        return $this->packingItems()->count();
    }

    public function getProgressAttribute(): int
    {
        if ($this->total_count === 0) return 0;
        return (int) round(($this->packed_count / $this->total_count) * 100);
    }

    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'beach'    => 'fa-umbrella-beach',
            'business' => 'fa-briefcase',
            'mountain' => 'fa-mountain',
            'city'     => 'fa-city',
            default    => 'fa-suitcase',
        };
    }

    public function getTypeColorAttribute(): string
    {
        return match($this->type) {
            'beach'    => 'warning',
            'business' => 'primary',
            'mountain' => 'success',
            'city'     => 'info',
            default    => 'secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'preparing' => 'In preparazione',
            'traveling' => 'In viaggio',
            'done'      => 'Completato',
            default     => '',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'preparing' => 'warning',
            'traveling' => 'primary',
            'done'      => 'success',
            default     => 'secondary',
        };
    }
}
