<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['user_id', 'name', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TemplateItem::class)->orderBy('order');
    }

    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'beach'    => 'fa-umbrella-beach',
            'business' => 'fa-briefcase',
            'mountain' => 'fa-mountain',
            'city'     => 'fa-city',
            default    => 'fa-layer-group',
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
}
