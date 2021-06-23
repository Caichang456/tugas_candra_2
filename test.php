<?php

$mobil = [
    [
        "id" => 1,
        "name" => "honda"
    ],
    [
        "id" => 2,
        "name" => "suzuki"
    ]
];
$warna = [
    [
        "mobil_id" => 1,
        "name" => "hijau",
    ],
    [
        "mobil_id" => 2,
        "name" => "Merah",
    ],
    [
        "mobil_id" => 1,
        "name" => "Kuning",
    ],
    [
        "mobil_id" => 1,
        "name" => "Biru",
    ]
];

foreach ($mobil as $m) {
    foreach ($warna as $w) {
        if (array_column($m, 'id') == array_column($w, "mobil_id")) {
            echo " " . $m . " " . $w . "<br>";
        }
    }
}
