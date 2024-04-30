<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    public static function getLocaleUrl(){

        $uri = \request()->path(); //получаем URI
        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], config('app.locales'))) {

            if ($segmentsURI[0] != config('app.locale')){
                return $segmentsURI[0];
            }

        }
        return null;
    }

    public static function getLocale(){

        $locale = self::getLocaleUrl();

        if ($locale){
            return $locale;
        }

        return config('app.locale');

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = self::getLocale();
        app()->setLocale($locale);

        return $next($request);
    }
}
