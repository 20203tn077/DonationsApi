<?php

namespace App\Utils;

use App\Models\Donation;
use App\Utils\ReferenceUtils;

class DonationUtils
{
    public static function request_payment($donation, $amount) {
        if ($donation && $amount) {
            $donation -> amount = $amount;
            $donation -> reference = ReferenceUtils::generate();
            return true;
        } else return false;
    }

    public static function confirm_payment($donation, $amount_paid) {
        if ($donation && $amount_paid) {
            $donation -> amount_paid = $amount_paid;
            $donation -> payment_status = $donation -> amount == $amount_paid ? 'SUCCESSFUL' : 'WRONG';
            return true;
        } else return false;
    }
}
