<?php 

namespace App\Music\Services\BandDjEventType;

use App\Music\Repositories\BandDjEventType\BandDjEventTypeInterface;

class BandDjEventTypeService
{
    public function __construct(BandDjEventTypeInterface $bandDjEventTypeInterface)
    {
        $this->bandDjEventTypeInterface = $bandDjEventTypeInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->bandDjEventTypeInterface->save($id = null, $request);
            activity()->log(sprintf('Band/Dj Event Type  created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Band/Dj Event Type by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getBandDjEventTypeData()
    {
        return $this->bandDjEventTypeInterface->getBandDjEventTypeData();
    }

    public function update($id, $request)
    {
        try {
            $this->bandDjEventTypeInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Band/Dj Event Type updated successfully of Event Name: %s by user: %s',
                    getNameByIdOfTable('band_dj_event_types', $id)->name,
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
                    getNameByIdOfTable('band_dj_event_types', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            $this->bandDjEventTypeInterface->delete($id);
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to delete Event of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function find($id)
    {
        return $this->bandDjEventTypeInterface->find($id);
    }
}
