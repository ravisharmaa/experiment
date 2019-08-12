<?php

namespace App\Http\Controllers\Monitor;

use App\Server;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Storage;

/**
 * Class GenerateFileController.
 */
class GenerateFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
    }

    /**
     * @param Request $request
     * @param $id
     * @param $server_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateFile(Server $server, $server_id)
    {
        $server = $server::findOrFail($server_id);

        if (file_exists($userDirectory = public_path('home/' . request()->user()->name))) {
            if ($server) {
                $fileName = $server->hostname . '_monitor.txt';
            } else {
                $fileName = rand(0, 2500000) . '_monitor.txt';
            }

            $path = "${userDirectory}/${fileName}";

            $ipaddress = $server->ipaddress;
            $hostname = $server->hostname;

            $monitor = "#! /bin/bash \n";
            $monitor = $monitor . "DATE_N_TIME=`date +%Y-%m-%d_%H-%M-%S`\n";

            $monitor = $monitor . "SIZENAME(){ " . "\n";
            $monitor = $monitor . "SIZET=" . '$' . "{1: -1} \n" .
                "if [ " . '$' . "SIZET == 'T' ]\n" .
                "then \n" .
                "echo " . '"$1"' . "|cut -d " . '"$SIZET"' . " -f1|awk '{ convert=$1 *1024; print convert" . '"G"' . "}'\n" .
                "elif [ " . '$' . "SIZET == 'M' ]\n" .
                "then \n" .
                "echo " . '"$1"' . "|cut -d " . '"$SIZET"' . " -f1|awk '{ convert=$1 /1024; print convert" . '"G"' . "}' \n" .
                "elif [ " . '$' . "SIZET == 'K' ]\n" .
                "then \n" .
                "echo " . '"$1"' . "|cut -d " . '"$SIZET"' . " -f1|awk '{ convert=$1 /1024 /1024; print convert" . '"G"' . "}' \n" .
                "else \n" .
                "echo $1 \n" .
                "fi \n" .
                "}\n";

            $monitor = $monitor . 'echo ' . '"Hostname,IpAddress';

            $value = 'echo';
            $value = $value . "\t" . '"' . $hostname . '"' . "," . '"' . $ipaddress . '"' . "," . "\\" . "\n";

            if ($server->getAttributeByName('Cpu')->toArray() != null) {
                $monitor = $monitor . ',SystemUptime';
                foreach ($server->getAttributeByName('Cpu') as $serverattributeCpu) {
                    $value = $value . "\t\t$(uptime | awk -F'( |,|:)+' '{print $6 $7" . '":' . '"$8"' . "hours:" . '"$9"' . "minutes" . '"' . "}')','" . "\\" . "\n";
                }
            }

            if ($server->getAttributeByName('Memory')->toArray() != null) {
                $monitor = $monitor . ',MemTotal,MemFree';
                foreach ($server->getAttributeByName('Memory') as $serverattributeMemory) {
                    $monitor_scripts_memory = "\t\t$(cat /proc/meminfo |grep " . '"MemTotal"' . " |awk '{print $2/1024/1024}')','" . "\\" . "\n" .
                        "\t\t$(cat /proc/meminfo |grep " . '"MemFree"' . "|awk '{print $2/1024/1024}')','" . "\\" . "\n";
                    $value = $value . $monitor_scripts_memory;
                }
            }
            $monitor = $monitor . ',LoadAverage';
            $value = $value . "\t\t$(uptime | awk -F" . '"," ' . "'{print $4}' |cut -f2 -d:)','" . "\\" . "\n";

            if ($server->getAttributeByName('Disk')->toArray() != null) {
                foreach ($server->getAttributeByName('Disk') as $serverattribute) {
                    $monitor = $monitor . ',' . $serverattribute->pivot->disk_name . '_DiskTotal,' . $serverattribute->pivot->disk_name . '_DiskUsed';

                    $monitor_scripts_disk = "\t\t$(SIZENAME $(df -h " . $serverattribute->pivot->disk_location . "|grep -vE '^Filesystem|tempfs'|tr '" . '\n' . "' ' '|awk '{ print $2}'))','" . "\\" . "\n";
                    $monitor_scripts_disk = $monitor_scripts_disk . "\t\t$(SIZENAME $(df -h " . $serverattribute->pivot->disk_location . "|grep -vE '^Filesystem|tempfs'|tr '" . '\n' . "' ' '|awk '{ print $3 }'))','" . "\\" . "\n";
                    $value = $value . $monitor_scripts_disk;

                }
            }

            if ($server->customs != null) {
                foreach ($server->customs as $key => $custom) {
                    $custom_array = explode(',', $custom->result);
                    foreach ($custom_array as  $customArray) {
                        $monitor = $monitor . ',' . (trim($customArray)) . '_Custom';
                    }
                    $value = $value . "\t\t$(" . $server->customs[$key]->path . ")','" . "\\" . "\n";
                }
            }


            foreach ($server->services as $key => $server_type) {
                $monitor = $monitor . ',' . $server_type->service_name;
            }
            $monitor = $monitor . '"' . "> /scripts/jvrscripts/csv/${hostname}" . "_" . "$" . "DATE_N_TIME.csv" . "\n";

            $counter = 0;
            foreach ($server->services as $server_port_value) {
                if ($counter == count($server->services) - 1) {
                    $value = $value .
                        "\t\t$((echo >" . $server_port_value->service_command . $server_port_value->service_port . ') &>/dev/null && echo ' . '"open"' . '|| echo ' . '"closed"' . ")" . "\\" . "\n";
                } else {
                    $value = $value .
                        "\t\t$((echo >" . $server_port_value->service_command . $server_port_value->service_port . ') &>/dev/null && echo ' . '"open"' . '|| echo ' . '"closed"' . ")','" . "\\" . "\n";
                }
                $counter = $counter + 1;
            }

            $value = $value . "\t\t>>/scripts/jvrscripts/csv/${hostname}" . "_" . "$" . "DATE_N_TIME.csv" . "\n";
            $monitor = $monitor . " " . $value;

            \File::put($path, $monitor);

            Session::flash('message', "Successfully generated scripts file");
            $url = 'home' . '/' . request()->user()->name . '/' . $fileName;
            Session::flash('file-url', url($url));
        } else {
            Session::flash('error-message', "Something went wrong");
        }

        return redirect()->back();

    }
}