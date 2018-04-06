<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescriptionContainerModel extends Model
{
    protected $table = 'description_container';
    
    protected $fillable = [
        'id','origin','destinity','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'container_id','user_id',
    ];
}
