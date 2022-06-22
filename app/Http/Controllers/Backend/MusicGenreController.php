<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Music\Services\MusicGenre\MusicGenreService;
use App\Http\Requests\MusicGenreRequest;
use File;
use Response;

class MusicGenreController extends Controller
{
    protected $musicGenre;

    public function __construct(
        MusicGenreService $musicGenre
    ) {
        $this->middleware('auth',['except' => ['storageLocationFileDisplay']]);
        $this->musicGenre           = $musicGenre;
    }

    public function index(Request $request)
    {   
    	$generes = $this->musicGenre->getMusicGenreData();
        
        return view('backend.components.music-genre.list',compact('generes'));
    }

    public function create(){
        return view('backend.components.music-genre.create');
    }

    public function store(MusicGenreRequest $request)
    {
        $response = $this->musicGenre->save($request->all());
        
        if ($response) {
            return redirect()->route('admin.genre.edit',$response->id)->withMessage('Successfully created Genre.');
        } else {
            return redirect()->back()->withErrors('Unable to save music-genre. Please try again')->withInput($request->all());
        }
    }

    public function edit($id){
       $genre = $this->musicGenre->find($id);
       return view('backend.components.music-genre.edit',compact('genre'));
    }

    public function update(MusicGenreRequest $request, $id)
    {
        if ($this->musicGenre->update($id, $request->all())) {
            return redirect()->back()->withMessage('Successfully updated Genre.');
        } else {
            return redirect()->back()->withErrors('Unable to update music-genre. Please try again')->withInput($request->all());
        }
    }
 

    public function getModalDelete($id = null)
    {
        $model         = 'genre';
        $confirm_route = $error = null;
        try {
            $genre       = $this->musicGenre->find($id);
            $confirm_route = route('admin.genre.delete', $genre->id);
            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();
            response()->json(['view' => $view]);
        } catch (UserNotFoundException $e) {
            dd($e->getMessage());
        }  
    }

    public function destroy($id = null)
    {
        if ($this->musicGenre->delete($id)) {
            return redirect()->route('admin.genre.list')->withMessage('Successfully deleted genre!');
        } else {
            return redirect()->back()->withErrors('Unable to delete music genre. Please try again');
        }
    }

    public function storageLocationFileDisplay($id)
    {
        $genre = $this->musicGenre->find($id);
        $path    = storage_path('app/' . $genre->image);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    // change Status
    public function statusChange($id)
    {
        try {
            $genre = $this->musicGenre->find($id);
            if ($genre->status == 1) {
                $genre->status = 0;
                $message           = trans_choice('music-genre.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $genre->status = 1;
                $message           = trans_choice('music-genre.success.status_publish', 1, ['count' => 1]);
            }

            if ($genre->save()) {
                return redirect()->route('admin.genre.list')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.genre.list')->withMessage($e->getMessge());
        }
         
    }
}
