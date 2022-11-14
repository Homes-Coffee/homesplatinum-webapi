<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Http\Responses\JsonResponser;

class StoreController extends Controller
{
    public function index()
    {
        try {
            $stores = Store::all();
            return (new JsonResponser())->success('Store Successfully', StoreResource::collection($stores));
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }

    public function show(Store $store)
    {
        try {
            return (new JsonResponser())->success("Store $store->name founded!", new StoreResource($store));
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
