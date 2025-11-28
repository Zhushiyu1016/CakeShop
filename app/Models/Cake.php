<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'user_id',
    ];

    /**
     * Get the user that owns the cake.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
