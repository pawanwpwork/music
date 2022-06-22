<?php 

namespace App\Music\Repositories\Event;

interface EventInterface
{
    public function save($id, $request);

    public function getEventData();

    public function find($id);

    public function findFromAlias($alias);

    public function findAll($filters = [], $status = 1);

    public function delete($id);

    public function postEventsave($request);
}

