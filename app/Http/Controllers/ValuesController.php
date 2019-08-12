<?php

namespace App\Http\Controllers;

use App\Server;
use App\Traits\ViewPresenters\AdditionalAttributesPresenters;

class ValuesController extends Controller
{
    use AdditionalAttributesPresenters;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Server $server
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Server $server)
    {
        //send the url parameter along to view
        $fetchedData = $server->values()->applyFilterFor(
            $server['urlParams'] = request()->period
        );

        $server['latest_values'] = $fetchedData->each(function (&$data) {
            return $data->created_at = $data->created_at->timezone(auth()->user()->timezone);
        });

        return view('entities.show  ', [
            'service' => json_encode($this->bakeAdditionalAttributes($server, request()->period)),
            'cpuTimeStamps' => json_encode($this->extractAttributeInformation($server, 'loadaverage'), 1),
            'freeMemory' => json_encode($this->extractAttributeInformation($server, 'memfree'), 1),
            'totalMemory' => json_encode($this->extractAttributeInformation($server, 'memtotal'), 1),
            'usedMemory' => json_encode($this->extractAttributeInformation($server, 'memused'), 1),
        ]);
    }
}
