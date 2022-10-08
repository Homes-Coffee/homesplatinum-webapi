<?php

namespace App\Http\Controllers\API\V1;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Http\Responses\JsonResponser;

class MembershipCardController extends Controller
{
    public function index()
    {
        try {
            $cards = Card::IsShown();
            return (new JsonResponser())->success('membership cards', new CardResource($cards));
        } catch (Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
