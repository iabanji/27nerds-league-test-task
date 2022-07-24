<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAllLeaguesRequest;
use App\Http\Requests\GetLeagueByIdRequest;
use App\League;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param GetAllLeaguesRequest $request
     * @return JsonResponse
     */
    public function allLeagues(GetAllLeaguesRequest $request): JsonResponse
    {
        $query = League::query();

        if ($request->has('start_timestamp')) {
            $query->where('start_timestamp', '>', Carbon::createFromTimestamp($request->get('start_timestamp')));
        }
        $leagues = $query->get()->pluck('id');
        return response()->json(compact('leagues'));
    }

    /**
     * @param GetLeagueByIdRequest $request
     * @param $league_id
     * @return JsonResponse
     */
    public function leagueById(GetLeagueByIdRequest $request, $league_id): JsonResponse
    {
        $league = League::find($league_id);
        return response()->json(compact('league'));
    }
}
