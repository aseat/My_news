<?php

namespace App;
use App\Models\Like;
use App\User;
use Illuminate\Support\Facades\Auth;
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
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
      'image_file_name', 'image_title',
    ];

    public function rules()
    {
        return [
            'title' => 'required|max:20',
            'body'  => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10240',
        ];
    }

    public function likes()
    {
    return $this->hasMany(Like::class, 'post_id');
    }
    public function messages()
    {
        return [
            'title.required' => 'タイトルは必須です。',
            'title.unique'   => 'タイトルが被っています',
            'title.max'      => 'タイトルは20文字以内で記入してください。',
            'text.required'  => '内容は必須です。',
            'image.mimes'    => 'ファイルタイプをjpeg,jpg,png,gifに設定してください。',
            'image.max'      => 'ファイルサイズを10MB以下に設定してください。',
        ];
    }

    public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($id, $likers)) {
      return true;
    } else {
      return false;
    }
  }
}
