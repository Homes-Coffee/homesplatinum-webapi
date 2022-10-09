<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\HomeFact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponser;

class HomesFactController extends Controller
{
    public function index()
    {
        try {

            // hanya tampil 24 jam
            $startDate = Carbon::now()->subDay()->format('Y-m-d H:i:s');
            $endDate   = Carbon::now()->format('Y-m-d H:i:s');

            $homesFact = HomeFact::whereBetween('published_at', [$startDate, $endDate])->get();

            if ($homesFact) {
                return (new JsonResponser())->success('Homefacts', $homesFact);
            } else {
                return (new JsonResponser())->success('No Story Homefact', (object) []);
            }

        } catch (\Throwable $th) {
            return (new JsonResponser())->exception($th);
        }
    }
}
