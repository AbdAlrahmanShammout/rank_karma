<?php

/**
 * Created by PhpStorm.
 * User: Abd Shammout
 * Date: 20/6/2022
 * Time: 12:35 AM
 */

namespace App\Traits;


trait helperTrait
{


    public function countNumberOfBeforeSelectedItems($currentRank, $per_page, $usersCount){
        if ($currentRank - (int)($per_page/2) <= 0)
            $numberOfElementsBeforeSelected = $currentRank;
        if ($currentRank - (int)($per_page/2) > 0)
            if ($currentRank + (int)($per_page/2) > $usersCount)
                $numberOfElementsBeforeSelected = $per_page - ($usersCount - $currentRank) - 1;
            else
                $numberOfElementsBeforeSelected = (int)($per_page/2);
        return $numberOfElementsBeforeSelected;
    }
}