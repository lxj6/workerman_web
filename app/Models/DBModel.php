<?php

namespace App\Models;


use App\Exceptions\BusinessException;
use Illuminate\Database\Eloquent\Model;

class DBModel extends Model
{
    public $timestamps = true;
    protected $dateFormat = 'U';
    protected $primaryKey = 'id';



    public static function saveItemById(int $id, array $array)
    {
        $query = static::query();
        $info = $query->find($id);
        if (is_null($info)) {
            throw new BusinessException('数据不存在');
        }
        foreach ($array as $key => $val) {
            $info->$key = $val;
        }
        $info->save();
    }



}
