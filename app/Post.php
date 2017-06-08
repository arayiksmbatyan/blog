<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
	protected $table = "posts";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'text', 'category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];


    public function category()
   {
       return $this->belongsTo('App\Category');
   }

}
