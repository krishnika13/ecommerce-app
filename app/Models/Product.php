<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image','price', 'size', 'color'];

    protected $casts = [
        'size' => 'array',
        'color' => 'array',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
