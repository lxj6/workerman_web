<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DBModel extends Model
{
    public $timestamps = true;
    protected $dateFormat = 'U';
    protected $primaryKey = 'id';
}
