<?php 

namespace App\Music\Services\Event;

use App\Music\Repositories\Event\EventInterface;

class EventService
{
    public function __construct(EventInterface $eventInterface)
    {
        $this->eventInterface = $eventInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->eventInterface->save($id = null, $request);
            if(auth()->user() != null)
                activity()->log(sprintf('Event created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));
            else
                activity()->log(sprintf('Event created successfully of id: %s by user : %s', $request['name'], null));
            
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Event by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getEventData()
    {
        return $this->eventInterface->getEventData();
    }

    public function findAll($filters)
    {
        return $this->eventInterface->findAll($filters);
    }

    public function update($id, $request)
    {
        try {
            $this->eventInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Event updated successfully : %s by user: %s',
                    getNameByIdOfTable('events', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Event of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->eventInterface->delete($id);
            activity()->log(
                sprintf(
                    'Event Deleted successfully: %s by user: %s',
                    getNameByIdOfTable('events', $id)->name,
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
        return $this->eventInterface->find($id);
    }

    public function findFromAlias($alias)
    {
        return $this->eventInterface->findFromAlias($alias);
    }


    public function postEventsave($request)
    {
        try {
            $response = $this->eventInterface->postEventsave($request);
            if(authGuardData('member')!= null)
                activity()->log(sprintf('Event created successfully of id: %s by member : %s', $request['name'], authGuardData('member')->first_name));
            else
                activity()->log(sprintf('Event created successfully of id: %s by member : %s', $request['name'], null));
            
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Event by member : %s', authGuardData('member')->id));

            return null;
        }
    }
}
