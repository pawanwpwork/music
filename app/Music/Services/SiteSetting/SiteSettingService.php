<?php 

namespace App\Music\Services\SiteSetting;

use App\Music\Repositories\SiteSetting\SiteSettingInterface;

class SiteSettingService
{
    public function __construct(SiteSettingInterface $siteSetting)
    {
        $this->siteSetting = $siteSetting;
    }

    public function save($request)
    {
        try {
            $response = $this->siteSetting->save($id = null, $request);
            activity()->log(sprintf('Site Setting created successfully of id: %s by user : %s', auth()->user()->first_name, getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Site Setting by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getSiteData()
    {
        return $this->siteSetting->getSiteData();
    }

    public function getFirst()
    {
        return $this->siteSetting->getFirst();
    }

    public function update($id, $request)
    {
        try {
            $this->siteSetting->save($id, $request);
            activity()->log(
                sprintf(
                    'Site Setting updated successfully : %s by user: %s',
                    getNameByIdOfTable('site_settings', $id)->title,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update product of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->siteSetting->delete($id);
            activity()->log(
                sprintf(
                    'Site Setting Deleted successfully : %s by user: %s',
                    getNameByIdOfTable('reviews', $id)->author,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to delete Category of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function find($id)
    {
        return $this->siteSetting->find($id);
    }
}
