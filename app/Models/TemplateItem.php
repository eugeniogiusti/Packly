<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateItem extends Model
{
    protected $fillable = ['template_id', 'name', 'category', 'order'];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
