<?php

namespace App\Utils;

class ReferenceUtils
{
    public function generate() {
        $rand_number = str_pad(strval(rand(1,99)), 5, '0', STR_PAD_LEFT);
        $timestamp = date('d m y H i s');
        return ("REF $rand_number $timestamp");
    }
}
