<?php 

namespace App\Music\Services\BandDjAgeGroup;

use App\Music\Repositories\BandDjAgeGroup\BandDjAgeGroupInterface;

class BandDjAgeGroupService
{
    public function __construct(BandDjAgeGroupInterface $bandDjAgeGroupInterface)
    {
        $this->bandDjAgeGroupInterface = $bandDjAgeGroupInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->bandDjAgeGroupInterface->save($id = null, $request);
            activity()->log(sprintf('Band/Dj Event Type  created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Band/Dj Event Type by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getBandDjAgeGroupData()
    {
        return $this->bandDjAgeGroupInterface->getBandDjAgeGroupData();
    }

    public function update($id, $request)
    {
        try {
            $this->bandDjAgeGroupInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Band/Dj Event Type updated successfully of Event Name: %s by user: %s',
                    getNameByIdOfTable('band_dj_age_groups', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update BandDj Event Type of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {

            activity()->log(
                sprintf(
                    'Band/Dj Event Type Deleted successfully of Event Name: %s by user: %s',
                    getNameByIdOfTable('band_dj_age_groups', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            $this->bandDjAgeGroupInterface->delete($id);
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to delete Event of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function find($id)
    {
        return $this->bandDjAgeGroupInterface->find($id);
    }
}
