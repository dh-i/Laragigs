<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'website', 'location', 'description', 'email', 'tags', 'logo', 'user_id'];

    // protected $hidden = ['user_id'];

    public function scopeFilter($query, array $filters)
    {

        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if ($filters['search'] ?? false) {
            $query->where('tags', 'like', '%' . request('search') . '%')->orWhere('title', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%');
        }
    }


    //Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
