<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\Song\SongService;
use File;
use Response;

class SongController extends Controller
{
    protected $songService;

    public function __construct(SongService $songService) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->songService           = $songService;
    }

    public function index(Request $request)
    {
    	$songs = $this->songService->getSongData();
        
        return view('backend.components.song.list',compact('songs'));
    }

    public function getModalDelete($id = null)
    {
        $model         = 'song';
        $confirm_route = $error = null;
        try {
            $song       = $this->songService->find($id);
            $confirm_route = route('admin.song.delete', $song->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->songService->delete($id)) {
            return redirect()->route('admin.song.list')->withMessage('Successfully deleted song');
        } else {
            return redirect()->back()->withErrors('Unable to delete song. Please try again');
        }
    }

}
