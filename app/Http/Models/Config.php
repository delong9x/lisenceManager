<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $table = 'configs';

    public static function getConfigByKey($key) {
        return self::where('key', $key)->first();
    }

    public static function setConfigByKey($key, $value) {
        $config = self::where('key', $key)->first();
        $config->value = $value;
        return $config->save();
    }

    public static function getAllConfig() {
        return self::orderBy('type', 'ASC')->orderBy('id', 'ASC')->get();
    }
}
