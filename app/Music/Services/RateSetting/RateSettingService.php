<?php 

namespace App\Music\Services\RateSetting;

use App\Music\Repositories\RateSetting\RateSettingInterface;

class RateSettingService
{
    public function __construct(RateSettingInterface $rateSettingInterface)
    {
        $this->rateSettingInterface = $rateSettingInterface;
    }

    public function getFirstRates()
    {
        return $this->rateSettingInterface->getFirstRates();
    }

}
