<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicationModel extends Model
{
    protected $table = 'ubication';
    
    protected $fillable = [
        'id','name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];
}
