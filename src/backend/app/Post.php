<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
/**
     * リレーション (従属の関係)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
  public function user()
    {
        return $this->belongsTo('app\User');
    }
    
}
