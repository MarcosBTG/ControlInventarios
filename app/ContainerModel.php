<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContainerModel extends Model
{
    protected $table = 'container';
    
    protected $fillable = [
        'id','type','status','capacity', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ubication_id',
    ];
}
