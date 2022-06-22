<?php 
namespace App\Music\Repositories\RateSetting;

use App\Models\RateSetting;
use App\Music\Repositories\RateSetting\RateSettingInterface;

class RateSettingRepository implements RateSettingInterface
{
    protected $rateSetting;

    public function __construct(RateSetting $rateSetting)
    {
        $this->rateSetting = $rateSetting;
    }

    public function getFirstRates(){
        return $this->rateSetting->first();
    }

}
