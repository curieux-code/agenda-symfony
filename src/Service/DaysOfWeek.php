<?php

namespace App\Service;

class DaysOfWeek {

    public function getInformation() {
        $week = ["dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"];
        $dayWeek = date('w');
        return $daysOfWeek = [$week[$dayWeek], $week[$dayWeek+1], $week[$dayWeek+2], $week[$dayWeek+3], $week[$dayWeek+4], $week[$dayWeek+5], $week[$dayWeek+6], $week[$dayWeek+7]];
    }
}
