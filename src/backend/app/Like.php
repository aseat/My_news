<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function user()
  {
      return $this->hasOne('App\user', 'id', 'user_id');
  }

  public function post()
    {
        return $this->hasOne('App\user');
    }
  

}