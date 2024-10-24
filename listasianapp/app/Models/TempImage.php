<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempImage extends Model
{
    use HasFactory;

    protected $table = 'TempImage';

    protected $fillable = [
        'image', 
        'create_time',
    ];

    public static function rules()
    {
        return [
            'image' => 'required|string|max:255',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'create_time' => 'Create Time',
        ];
    }

    public static function search($params)
    {
        $query = self::query();

        if (isset($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (isset($params['image'])) {
            $query->where('image', 'like', '%' . $params['image'] . '%');
        }

        if (isset($params['create_time'])) {
            $query->where('create_time', 'like', '%' . $params['create_time'] . '%');
        }

        return $query->get();
    }
}
