<?php
function sec2human($time) {
    $seconds = $time%60;
    $mins = floor($time/60)%60;
    $hours = floor($time/60/60)%24;
    $days = floor($time/60/60/24);
    return $days > 0 ? $days . ' day'.($days > 1 ? 's' : '') : $hours.':'.$mins.':'.$seconds;
}

function calculate_percentage($used, $total){
    return @round(100 - $used / $total * 100, 2);
}

function kb2bytes($kb){
    return round($kb * 1024, 2);
}

function numbers_only($string){
    return preg_replace('/[^0-9]/', '', $string);
}

$array = array();

// Get the uptime...

$fh = fopen('/proc/uptime', 'r');
$uptime = fgets($fh);
fclose($fh);
$uptime = explode('.', $uptime, 2);
$array['uptime'] = sec2human($uptime[0]);

// Get RAM Usage

$fh = fopen('/proc/meminfo', 'r');
$mem = 0;
while ($line = fgets($fh)) {
    $pieces = array();
    if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
        $memtotal = $pieces[1];
    }
    if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
        $memfree = $pieces[1];
    }
    if (preg_match('/^Cached:\s+(\d+)\skB$/', $line, $pieces)) {
        $memcache = $pieces[1];
        break;
    }
}
fclose($fh);

$memmath = $memcache + $memfree;
$memmath2 = $memmath / $memtotal * 100;

//$memoryFree = round($memmath2);
//if ($memoryFree >= "51") {
//    $memlevel = 'progress-bar-success';
//} elseif ($memoryFree <= "30") {
//    $memlevel = '';
//} else {
//    $memlevel = 'progress-bar-danger';
//}
//$array['memory'] = '<div class="progress progress-striped active">
//                              <div class="progress-bar '.$memlevel.'"  role="progressbar" style="width: '.$memoryFree.'%">
//                                '.$memoryFree.'%
//                              </div>
//                            </div>';

$array['memory'] = round($memmath2);


// Get Server Load

$load = sys_getloadavg();
$array['load'] = $load[0].', '.$load[1].', '.$load[2];


// Get Free Disk Space

$hddtotal = disk_total_space("/home");
$hddfree = disk_free_space("/home");
$hddmath = $hddfree / $hddtotal * 100;
//$hdd = round($hddmath);

//if ($hdd >= "51") {
//    $hddlevel = 'progress-bar-success';
//} elseif ($hdd <= "30") {
//    $hddlevel = '';
//} else {
//    $hddlevel = 'progress-bar-danger';
//}
//
//$array['disk'] = '<div class="progress progress-striped active">
//                              <div class="progress-bar '.$hddlevel.'"  role="progressbar" style="width: '.$hdd.'%">
//                                '.$hdd.'%
//                              </div>
//                            </div>';

$array['disk'] = round($hddmath);

// Return the JSON
echo json_encode($array);