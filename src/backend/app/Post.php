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
        return $this->hasOne('App\user', 'id', 'user_id');
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
}
