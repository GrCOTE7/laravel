<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Film extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'year', 'description'];

    public function categories(): MorphToMany 
    { 
        return $this->morphedByMany(Category::class, 'filmable'); 
    } 
    
    public function actors(): MorphToMany 
    { 
        return $this->morphedByMany(Actor::class, 'filmable'); 
    }
}
