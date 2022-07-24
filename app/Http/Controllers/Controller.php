<?php

namespace App\Http\Controllers;

use App\League;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function allLeagues(Request $request): JsonResponse
    {
        $this->validate($request, [
            'start_timestamp' => ['integer'],
        ]);

        $query = League::query();

        if ($request->has('start_timestamp')) {
            $query->where('start_timestamp', '>', Carbon::createFromTimestamp($request->get('start_timestamp')));
        }
        $leagues = $query->get()->pluck('id');
        return response()->json(compact('leagues'));
    }

    /**
     * @param Request $request
     * @param int $league_id
     * @return JsonResponse
     */
    public function leagueById(Request $request, int $league_id): JsonResponse
    {
        $league = League::find($league_id);
        if (!$league) {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
        return response()->json(compact('league'));
    }
}
