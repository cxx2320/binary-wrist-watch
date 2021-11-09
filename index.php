<?php

declare(strict_types=1);

use think\Image;


include 'vendor/autoload.php';

function getHour(int $hour)
{
    if ($hour > 12 || $hour < 0) {
        throw new Exception('illegal param');
    }
    $t = [8, 4, 2, 1];
    $result = [];
    for ($i = 0; $i < count($t); $i++) {
        if ($hour < $t[$i]) {
            $result[$i] = 0;
            continue;
        }
        $hour = $hour - $t[$i];
        $result[$i] = $t[$i];
    }
    return $result;
}

function getMinute(int $minute)
{
    if ($minute > 59 || $minute < 0) {
        throw new Exception('illegal param');
    }
    $t = [32, 16, 8, 4, 2, 1];
    $result = [];
    for ($i = 0; $i < count($t); $i++) {
        if ($minute < $t[$i]) {
            $result[$i] = 0;
            continue;
        }
        $minute = $minute - $t[$i];
        $result[$i] = $t[$i];
    }
    return $result;
}


function genHour()
{
    for ($i = 0; $i < 13; $i++) {
        $res = getHour($i);
        $text = ['◇', '◇', '◇', '◇'];
        for ($j = 0; $j < 4; $j++) {
            if ($res[$j] != 0) {
                $text[$j] = '◆';
            }
        }
        $image = Image::open('./tem.png');
        $image
            ->text(implode('', $text), './font/STSONG.TTF', 22, '#000000', Image::WATER_CENTER)
            ->save('./hour/' . $i . '.png');
    }
}

function genMinute()
{
    for ($i = 0; $i < 60; $i++) {
        $res = getMinute($i);
        $text = ['◇', '◇', '◇', '◇', '◇', '◇'];
        for ($j = 0; $j < 6; $j++) {
            if ($res[$j] != 0) {
                $text[$j] = '◆';
            }
        }
        $image = Image::open('./tem.png');
        $image
            ->text(implode('', $text), './font/STSONG.TTF', 22, '#000000', Image::WATER_CENTER)
            ->save('./minute/' . $i . '.png');
    }
}
genHour();
genMinute();