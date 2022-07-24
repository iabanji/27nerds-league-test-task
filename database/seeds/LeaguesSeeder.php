<?php

use App\League;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LeaguesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        League::query()->truncate();
        $data = json_decode(file_get_contents(storage_path('leagues_data.json')), true);

        foreach ($data['infos'] as $league) {
            unset($league['league_id']);
            $league['most_recent_activity'] = Carbon::createFromTimestamp($league['most_recent_activity']);
            $league['start_timestamp'] = Carbon::createFromTimestamp($league['start_timestamp']);
            $league['end_timestamp'] = Carbon::createFromTimestamp($league['end_timestamp']);
            League::create($league);
        }
    }
}
