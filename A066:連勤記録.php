<?php
while ($stdin = trim(fgets(STDIN))) {
    $stdin_array[] = $stdin;
}

$work_count_arr = array_splice($stdin_array, 0, 1);

// 仕事始めの数字が小さい順に並び変える
sort($stdin_array, SORT_NUMERIC);

$count = 0;
$start_date = 1;
$last_date = 1;

for ($i = 0; $i < $work_count_arr[0]; $i++) {
    $current = explode(" ", $stdin_array[$i]);
    
    // 連続して続くとき
    if ($current[0] -1 == $last_date) {
        $last_date = $current[1];
        
    // 連勤期間内ではない
    } elseif ($current[0] -1 > $last_date) {
        $stuck[] = $count;
        $start_date = $current[0];
        $last_date = $current[1];
    } else {
        $last_date = $last_date <= $current[1] ? $current[1] : $last_date;
    }

    
    $count = $last_date - $start_date +1;
        
}

$stuck[] = $count;
echo(max($stuck)."\n");
