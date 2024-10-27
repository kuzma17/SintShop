<?php

namespace App\Http\Controllers;

use App\Http\Resources\NovaPoshtaCityResource;
use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;

class NovaPoshtaController extends Controller
{
    protected $np_service;
    public function __construct(NovaPoshtaService $service)
    {
        $this->np_service = $service;
    }
    public function searchCity($key)
    {
        $data = $this->np_service->searchCity($key);

        return json_encode($data);

    }

    public function getWarehouses($city_ref, $page=1)
    {
      return json_encode($this->np_service->getWarehouses($city_ref, $page));

    }

    public function index(Request $request)
    {

        if($request->has('city_key')){
            return $this->searchCity($request->city_key);
        }

        if($request->has('city_ref')){
            $page = $request->has('page')? $request->page: 1;
            return $this->getWarehouses($request->city_ref, $page);
        }

    }
}
