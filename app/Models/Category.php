<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function bloods(): BelongsToMany
    {
        return $this->belongsToMany(Blood::class, 'bloods_categories');
    }
}
