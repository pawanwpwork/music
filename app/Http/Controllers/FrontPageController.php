<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class FrontPageController extends Controller
{
    public function pageDetail($alias)
    {
      $page = Page::where('alias',$alias)->first();
      return view('frontend.page-detail',compact('page'));
    }
}
