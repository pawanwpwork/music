<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
     public function index(){

     	$pages = Page::get();

    	return view('backend.components.page.index',compact('pages'));

    }   


    public function create(){

        return view('backend.components.page.create');

    }

    public function store(Request $request){

        $attachment            = imageUploadPublic( $request->file('attachment') ? $request->file('attachment') : null, "uploads");

    	$request 	           = $request->all();

        $request['alias']      = unique_slug($request['title'],'pages');
        

        $request['attachment'] = $attachment;

        $page			       = Page::create($request);

        if ($page) {
            return redirect()->route('admin.page.edit',$page->id)->withMessage('Successfully created Page');
        } else {
            return redirect()->back()->withErrors('Unable to save Page. Please try again')->withInput($request->all());
        }
    }


    public function edit($id){

       $page 	= Page::find($id);
   
       return view('backend.components.page.edit',compact('page'));
    }

    public function update( $id, Request $request ){
    	
        $attachment             = imageUploadPublic( $request->file('attachment') ? $request->file('attachment') : null, "uploads");
        
        $page                   = Page::find($id);

    	$request 				= $request->all();

        // $request['alias'] 		= unique_slug($request['title'],'pages',$page->id);
        
        
        $attachment_image       = isset($attachment) ? $attachment : $page->attachment;

        $request['attachment']  = $attachment_image;

        $pageUpdate             = $page->update($request);

         if ($pageUpdate) 
         {
            return redirect()->route('admin.page.edit',$page->id)->withMessage('Successfully updated Page');
        } 
        else 
        {
            return redirect()->back()->withErrors('Unable to update page. Please try again')->withInput($request->all());
        }
    }

    public function getModalDelete($id = null)
    {
        $model         = 'page';

        $confirm_route = $error = null;

        try {

            $page       = Page::find($id);

            $confirm_route = route('admin.page.delete', $page->id);

            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();

        } catch (UserNotFoundException $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }  
    }

    public function destroy($id = null)
    {
    	$page = Page::find($id);

        if ($page->delete($id)) {
            return redirect()->route('admin.page.index')->withMessage('Successfully deleted Page');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }


    public function getModalStatus($id = null)
    {
        $model         = 'page.status';

        $confirm_route = $error = null;

        try {

            $page      = Page::find($id);

            $confirm_route = route('admin.page.status', $page->id);

            return view('layouts.modal_confirmation', compact('error', 'model', 'confirm_route'))->render();

        } catch (UserNotFoundException $e) {
            return redirect()->back()->withErrors('Something went wrong!');
        }  
    }

    public function statusChange($id)
    {
        try {
            $page = Page::find($id);
            if ($page->status == 1) {
                $page->status = 0;
                $message           = trans_choice('page.success.status_unpublish', 1, ['count' => 1]);
            } else {
                $page->status = 1;
                $message           = trans_choice('page.success.status_publish', 1, ['count' => 1]);
            }

            if ($page->save()) {
                return redirect()->route('admin.page.index')->withMessage($message);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.page.index')->withMessage($e->getMessge());
        }
    }
}
