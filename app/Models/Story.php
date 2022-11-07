<?php

namespace App\Models;

use App\Helper\StorageSetup;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory, StorageSetup, Sluggable;

    protected $fillable = ['user_id', 'title', 'slug', 'content', 'image', 'publish_date', 'status'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getIsEditAttribute($value){
        $user = Auth::user();
        if(!$user){
            return false;
        }
        if($this->user_id == $user->id){
            return true;
        }
        return false;
    }

    public function scopeCheckStatusActive($query){
        return $query->where('status', 1);
    }

    public function scopeIsPublish($query){
        return $query->where("publish_date", "<=", Carbon::now());
    }

}
