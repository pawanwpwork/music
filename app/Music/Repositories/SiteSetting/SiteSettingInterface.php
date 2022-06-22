<?php 

namespace App\Music\Repositories\SiteSetting;

interface SiteSettingInterface
{
    public function save($id, $request);

    public function getSiteData();

    public function getFirst();

    public function find($id);

    public function delete($id);
}

