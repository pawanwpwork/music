<?php 

namespace App\Music\Services\BandDjBook;

use App\Music\Repositories\BandDjBook\BandDjBookInterface;

class BandDjBookService
{
    public function __construct(BandDjBookInterface $bandDjBookInterface)
    {
        $this->bandDjBookInterface = $bandDjBookInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->bandDjBookInterface->save($id = null, $request);
            if(auth()->user()){
                activity()->log(sprintf('Band/Dj Book  created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));
            }
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Band/Dj Book by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getBandDjBookData()
    {
        return $this->bandDjBookInterface->getBandDjBookData();
    }

    public function update($id, $request)
    {
        try {
            $this->bandDjBookInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Band/Dj Event Type updated successfully of Event Name: %s by user: %s',
                    getNameByIdOfTable('book_band_dj', $id)->type,
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
                    getNameByIdOfTable('book_band_dj', $id)->type,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            $this->bandDjBookInterface->delete($id);
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to delete Event of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function find($id)
    {
        return $this->bandDjBookInterface->find($id);
    }

    public function bankBandDjPostsave($request)
    {
        try {
            $response = $this->bandDjBookInterface->bankBandDjPostsave($request);
            if(authGuardData('member')){
                activity()->log(sprintf('Band/Dj Book  created successfully of id: %s by member : %s', $request['name'],authGuardData('member')->first_name));
            }
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Band/Dj Book by member : %s', authGuardData('member')->id));

            return null;
        }
    }

    public function cancelBooking($id)
    {
        try {

            activity()->log(
                sprintf(
                    'Band/Dj Event Type Cancel successfully of Event Name: %s by user: %s',
                    getNameByIdOfTable('book_band_dj', $id)->type,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            $this->bandDjBookInterface->cancelBooking($id);
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to Cancel Event of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }
}
