<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;

class CardController extends Controller
{
    public function index()
    {
        try {
            $card = Card::select("uuid", "title", "description", "type", "image")->whereNull('type')->get();
            return (new JsonResponser())->success('Membership Card Ditemukan', $card);
        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
