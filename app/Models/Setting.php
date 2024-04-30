<?php

namespace App\Models;

use App\Http\Middleware\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'locale',
        'key',
        'value',
    ];

    public function getSettings()
    {
        $locale = Localization::getLocale() ;

        return self::where('locale', $locale)
            ->orWhere('locale', 'all')
            ->get(['key', 'value']);
    }

    public function getAllSettings(){

        $settings = self::get(['locale','key', 'value']);

        $set = [];

        foreach ($settings as $setting){

            $suffix = '';
            if ($setting->locale != 'all'){
                $suffix = '__'.$setting->locale;
            }

            $set[$setting->key.$suffix] = $setting->value;
        }

        return $set;

    }

    public function setAllSettings($settings){

        foreach ($settings as $key => $value){
            $param = explode('__', $key);
            $row = Setting::where('key',$param[0])->where('locale', $param[1])->first();
            $row->value = $value;
            $row->save();
        }
    }


}
