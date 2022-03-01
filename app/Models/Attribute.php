<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function facts()
    {
        return $this->hasMany(Fact::class);
    }

    public function securities()
    {
        return $this->belongsToMany(Security::class, 'facts', 'attribute_id', 'security_id');
    }
}
