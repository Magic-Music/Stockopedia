<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'symbol',
    ];

    public function facts()
    {
        return $this->hasMany(Fact::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'facts', 'security_id', 'attribute_id')->withPivot('value');
    }
}
