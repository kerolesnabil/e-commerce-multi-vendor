<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;

    /**
     * the relation to eager load on every query
     *
     * @var array
     */
    protected $with=['translation'];

    protected $translatedAttributes=['value'];

    /**
     * the attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable=['key','is_translatable','plain_value'];

    /**
     * the attributes that are cast to native types
     *
     * @var array
     */

    protected $casts=[
      'is_translatable'=>'boolean',
    ];

    public static function setMany($settings)
    {
        foreach ($settings as $key=>$value){
            self::set($key,$value);
        }
    }

    /**
     * @param string $key
     * @param mixed  $value
     * @return void
     */
    public static function set($key,$value)
    {
        if($key==='translatable'){
            return static::setTranslatableSettings($value);
        }
        if(is_array($value)){
            $value=json_encode($value);
        }
        static::updateOrCreate(['key'=>$key],['plain_value'=>$value]);
    }

    /**
     * @param array $settings
     * @return void
     */
    public static function setTranslatableSettings($settings=[])
    {
        foreach ($settings as $key=>$value)
        {
            static::updateOrCreate(['key'=>$key],[
               'is_translatable'=>true,
               'value'=>$value
            ]);
        }
    }

}
