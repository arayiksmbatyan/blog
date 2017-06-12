<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
	protected $table = "categories";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
   {
       return $this->belongsTo('App\User');
   }

   public function posts() 
   {
   		return $this->hasMany('App\Post', 'category_id', 'id');
   }
}
