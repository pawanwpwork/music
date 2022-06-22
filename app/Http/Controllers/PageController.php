<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function pageDetail($alias)
    {
      $page = Page::where('alias','about-us')->first();
      return view('frontend.page-detail',compact('page'));
    }
}
