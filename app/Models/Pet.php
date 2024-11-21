<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // 定义可填充的字段，防止批量赋值漏洞
    protected $fillable = [
        'name',
        'age',
        'species',
        'breed',
        'gender',
        'color',
        'size',
        'vaccinated',
        'healthStatus',
        'personality',
        'description',
        'photos',
        'videos',
        'addedBy',
        'addedByRole',
        'verified'
    ];

    protected $casts = [
        'healthStatus' => 'array',
        'photos' => 'array',
        'videos' => 'array',
        'vaccinated' => 'boolean',
        'verified' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'addedBy');
    }
}
