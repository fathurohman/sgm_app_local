<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class roleuser extends Model
{
    protected $table = 'role_user';
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function roles()
    {
        return $this->belongsTo('App\Model\role', 'role_id');
    }
}
