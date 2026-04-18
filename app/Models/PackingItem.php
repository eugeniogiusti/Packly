<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackingItem extends Model
{
    protected $fillable = [
        'trip_id',
        'name',
        'category',
        'packed',
        'unpacked',
        'order',
    ];

    protected $casts = [
        'packed'   => 'boolean',
        'unpacked' => 'boolean',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function getCategoryIconAttribute(): string
    {
        return match($this->category) {
            'documents'   => 'fa-passport',
            'clothes'     => 'fa-tshirt',
            'hygiene'     => 'fa-pump-soap',
            'tech'        => 'fa-laptop',
            'accessories' => 'fa-glasses',
            'gear'        => 'fa-hiking',
            default       => 'fa-box',
        };
    }

    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'documents'   => 'Documenti',
            'clothes'     => 'Vestiti',
            'hygiene'     => 'Igiene',
            'tech'        => 'Tech',
            'accessories' => 'Accessori',
            'gear'        => 'Gear',
            default       => 'Altro',
        };
    }
}
