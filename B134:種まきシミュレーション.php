<?php
while ($stdin = trim(fgets(STDIN))) {
    $stdin_array[] = $stdin;
}

$hatake_size = explode(" ", $stdin_array[0]);
$hatake_box = [];

// 畑の行数、箱を作る Y
for ($i = 1; $i <= $hatake_size[0]; $i++) {
    // 畑の列数、箱を作る X
    for ($j = 1; $j <= $hatake_size[1]; $j++) {
        $hatake_box[$i][$j] = 0;
    }
}

function make_line($y, $masu, $X, &$hatake_box, $hatake_size) {
    for ($j = 0; $j < $masu; $j++) {
        $a = $X-($masu-$j);
        if ($a > 0) {
            $hatake_box[$y][$a]++;
        }
        $b = $X+($masu-$j);
        if ($b <= $hatake_size[1]) {
            $hatake_box[$y][$b]++;
        }
    }
    $hatake_box[$y][$X]++;
}

function add_line($x, $masu, $Y, &$hatake_box, $hatake_size) {
    for ($j = 0; $j < $masu-1; $j++) {
        $a = $Y-(($masu-1)-$j);
        if ($a > 0) {
            $hatake_box[$a][$x]++;
        }
        $b = $Y+(($masu-1)-$j);
        if ($b <= $hatake_size[0]) {
            $hatake_box[$b][$x]++;
        }
    }
    $hatake_box[$Y][$x]++;
}

for ($i = 2; $i <= $stdin_array[1] + 1; $i++) {
    // 0 高さ、1 列、2 行
    $seeds = explode(" ", $stdin_array[$i]);
    
        // 基点 
    $X = $seeds[1];
    $Y = $seeds[2];
    
    if($seeds[0] == 1) {
        $hatake_box[$Y][$X]++;
        continue;
    }
    
    // 基点から何マス周り蒔くのか
    $masu = (int) floor($seeds[0]/2);
    
    // 上段一列
    if ($Y-$masu > 0) {
        make_line($Y-$masu, $masu, $X, $hatake_box, $hatake_size);
    }
    
    // 下段一列
    if ($Y+$masu <= $hatake_size[0]) {
        make_line($Y+$masu, $masu, $X, $hatake_box, $hatake_size);
    }

    // 左側
    if ($X-$masu > 0) {
        add_line($X-$masu, $masu, $Y, $hatake_box, $hatake_size);
    }
    
    // 右側
    if ($X+$masu <= $hatake_size[1]) {
        add_line($X+$masu, $masu, $Y, $hatake_box, $hatake_size);
    }

}

foreach ($hatake_box as $value) {
    for ($i = 1; $i <= count($value); $i++) {
        if ($i == count($value)) {
            echo($value[$i]);
            continue;
        }
        echo($value[$i] . " ");
    }

    echo("\n");
}
