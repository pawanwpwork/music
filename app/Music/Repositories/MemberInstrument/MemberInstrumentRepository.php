<?php 
namespace App\Music\Repositories\MemberInstrument;

use App\Models\MemberInstrument;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class MemberInstrumentRepository implements MemberInstrumentInterface
{
    protected $memberInstrument;

    public function __construct(MemberInstrument $memberInstrument)
    {
        $this->memberInstrument = $memberInstrument;
    }

    public function save($id, $request)
    {
        if ($id) {

            $instrument             = imageUploadPost( isset($request['instrument']) ? $request['instrument'] : null, "instrument");

            $request['member_id'] =  authGuardData('member')->id;

            $request['instrument']  = $instrument;

            return $memberInstrument->update($request);
        }

        $instrument             = imageUploadPost( isset($request['instrument']) ? $request['instrument'] : null, "instrument");

        $request['instrument']  = $instrument;

        $request['member_id'] =  authGuardData('member')->id;
        
        $memberInstrument       = $this->memberInstrument->create($request);

        return $memberInstrument;
    }


    public function find($id){
        $instrument = $this->memberInstrument->find($id);
        return $instrument;
    }
}
