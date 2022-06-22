<?php 

namespace App\Music\Services\MemberInstrument;

use App\Music\Repositories\MemberInstrument\MemberInstrumentInterface;

class MemberInstrumentService
{
    public function __construct(MemberInstrumentInterface $memberInstrument)
    {
        $this->memberInstrument = $memberInstrument;
    }

    public function save($request)
    {
        try {
            $response = $this->memberInstrument->save($id = null, $request);
            activity()->log(sprintf('Member Instrument created successfully of id: %s by user : %s', authGuardData('member')->first_name, authGuardData('member')->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member Instrument by user : %s', authGuardData('member')->id));

            return null;
        }
    }

    public function update($id, $request)
    {
        try {
            $this->memberInstrument->save($id, $request);
            activity()->log(
                sprintf(
                    'Membership Instrument updated successfully :by user: %s',
                    '',
                    authGuardData('member')->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member Instrument of id : %s by user : %s', $id, authGuardData('member')->id));

            return null;
        }
    }

    public function find($id){
        $instrument = $this->memberInstrument->find($id);
        return $instrument;
    }
}
