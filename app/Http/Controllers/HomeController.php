<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Music\Services\Event\EventService;
use App\Music\Services\SiteSetting\SiteSettingService;
use App\Music\Services\SliderImage\SliderImageService;
use App\Http\Requests\EventRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\BandDjBookRequest;
use App\Music\Services\BandDjBook\BandDjBookService;
use App\Music\Services\Product\ProductService;
use App\Music\Services\BandDjEventType\BandDjEventTypeService;
use App\Music\Services\BandDjAgeGroup\BandDjAgeGroupService;
use App\Music\Services\RateSetting\RateSettingService;
use App\Music\Services\Category\CategoryService;
use App\Music\Services\Member\MemberService;
use App\Models\MembershipType;
use App\Models\MembershipSettings;
use App\Models\ServiceOrder;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Member;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Page;
use Carbon\Carbon;
use DB;
use App\Models\Event;

class HomeController extends Controller
{
   protected $eventService;

   protected $bandDjEventTypeService;

   protected $bandDjAgeGroupService;

   protected $rateSettingService;

   protected $categoryService;

   protected $productService;

   protected $memberService;

   public function __construct(
    MemberService $memberService,

      EventService $eventService, 
      SiteSettingService $siteSetting, 
      SliderImageService $sliderImageService, 
      BandDjBookService $bandDjBookService, 
      BandDjAgeGroupService $bandDjAgeGroupService, 
      BandDjEventTypeService $bandDjEventTypeService, 
      RateSettingService $rateSettingService,
      CategoryService $categoryService,
      ProductService $productService
   ){
    $this->memberService          = $memberService;
      $this->eventService = $eventService;
      $this->siteSetting = $siteSetting;
      $this->sliderImageService = $sliderImageService;
      $this->bandDjBookService = $bandDjBookService;
      $this->bandDjEventTypeService = $bandDjEventTypeService;
      $this->bandDjAgeGroupService = $bandDjAgeGroupService;
      $this->rateSettingService = $rateSettingService;
      $this->categoryService = $categoryService;
      $this->productService = $productService;
      $this->middleware('auth:member',['except' => ['index','about','eventView','eventSinglePage','eventPostView','buyClassified','classifiedSinglePage','cdStore','allCdStore','cdSinglePage','contactPost','contact','eventViewAjax','productClassifiedCategory','voscastPage','allEventView','allClassified']]);
   }

   public function index(){
      
      $upcomingEvents = DB::table('events')->whereDate('date_end','>=',date('Y-m-d'))->where('status','approved')->whereNull('deleted_at')->orderBy('event_end_date','ASC')->take(10)->get();
      
      $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereNull('deleted_at')->where('products.status',1)->where('products.is_featured',1)->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->get();

      $classifiedProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->where('products.status',1)->whereIn('category_id', [5,6,7,8])->orderBy('id', 'desc')->get();

      $newArrivals = Product::where('status',1)->orderBy('id','desc')->get();

   	return view('home', compact('upcomingEvents', 'cdProducts','newArrivals','classifiedProducts'));
   }

   public function about(){
      $page = Page::where('alias','about-us')->first();
      return view('frontend.about',compact('page'));
   }
   
   public function eventView(Request $request){

      $filters = $request->all();

      if(isset( $request->page ) && $request->page > 1 )
      {
         $page = $request->page;    
      }
      else
      {
         $page = 0;  
      }
      $perPage = 6;
      $skipData = $perPage * ( $page -1);
   
      if( isset($filters['from_date']) && isset($filters['to_date']))
      {
         $upcomingEvents = DB::table('events')->whereDate('event_start_date','>=',date('Y-m-d',strtotime($filters['from_date'])))->whereDate('event_end_date','<=',date('Y-m-d',strtotime($filters['to_date'])))->whereNull('deleted_at')->where('status','!=','pending')->take(10)->orderby('event_end_date','ASC')->skip($skipData)->take($perPage)->get();
      
         $totalEvent  = count( DB::table('events')->whereDate('event_start_date','>=',date('Y-m-d',strtotime($filters['from_date'])))->whereDate('event_end_date','<=',date('Y-m-d',strtotime($filters['to_date'])))->whereNull('deleted_at')->where('status','!=','pending')->take(10)->orderby('event_end_date','ASC')->get() );
       }
       else
       {
         $upcomingEvents = DB::table('events')->whereDate('date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->where('status','!=','pending')->take(10)->orderby('event_end_date','ASC')->skip($skipData)->take($perPage)->get();
      
         $totalEvent              = count( DB::table('events')->whereDate('date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->where('status','!=','pending')->take(10)->orderby('event_end_date','ASC')->get() ); 
       }  
     

      $maxNumPage = ceil($totalEvent/$perPage);;

      return view('frontend.event.view', compact('upcomingEvents','maxNumPage','totalEvent','page','perPage'));
   }
   
   public function allEventView(Request $request){

      $filters = $request->all();

      if( isset($filters['from_date']) && isset($filters['to_date']))
      {
         $upcomingEvents = DB::table('events')->whereDate('event_start_date','>=',date('Y-m-d',strtotime($filters['from_date'])))->whereDate('event_end_date','<=',date('Y-m-d',strtotime($filters['to_date'])))->whereNull('deleted_at')->where('status','!=','pending')->orderby('event_end_date','ASC')->get();
      
         $totalEvent  = count( DB::table('events')->whereDate('event_start_date','>=',date('Y-m-d',strtotime($filters['from_date'])))->whereDate('event_end_date','<=',date('Y-m-d',strtotime($filters['to_date'])))->whereNull('deleted_at')->where('status','!=','pending')->take(10)->orderby('event_end_date','ASC')->get() );
       }
       else
       {
         $upcomingEvents = DB::table('events')->whereDate('date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->where('status','!=','pending')->orderby('event_end_date','ASC')->get();
      
         $totalEvent              = count( DB::table('events')->whereDate('date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->where('status','!=','pending')->orderby('event_end_date','ASC')->get() ); 
       }  
     

      return view('frontend.event.allview', compact('upcomingEvents','totalEvent'));
   }

    public function eventViewAjax(Request $request)
    {

      $upcomingEvents = DB::table('events')->whereDate('event_end_date','>=',$request->caleandar_data)->whereNull('deleted_at')->where('status','approved')->take(10)->orderby('event_end_date','ASC')->get();

      $view = view('frontend.event.ajax-view', compact('upcomingEvents'))->render();

      return response()->json(['html'=>$view],200);
   }

   public function eventSinglePage($alias)
   {
      $event = $this->eventService->findFromAlias($alias);

      return view('frontend.event.single-page', compact('event'));
   }

   public function eventPostView()
   {
      $rate = $this->rateSettingService->getFirstRates();

      return view('frontend.event.post', compact('rate'));
   }

   public function eventPost(EventRequest $request){
      
      $response = $this->eventService->postEventsave($request->all());
      
      if ($response) {
         
         $this->addToCartForCharge($response,'event');

         return redirect()->route('frontend.cart')->withMessage('Successfully Post Your event and Item has been added to cart!');

      } else {
          return redirect()->back()->withErrors('Unable to save event. Please try again')->withInput($request->all());
      }
   }

   public function bookBandDj(){

      $rate = $this->rateSettingService->getFirstRates();
              
      $ages = $this->bandDjAgeGroupService->getBandDjAgeGroupData();

      $types = $this->bandDjEventTypeService->getBandDjEventTypeData();

      return view('frontend.book-band.post', compact('ages', 'types', 'rate'));
   }

   public function bookBandDjPost(Request $request){
      
      $response = $this->bandDjBookService->bankBandDjPostsave($request->all());
      

      if ($response) {
         
         $this->addToCartForCharge($response,'book_band_dj');

         return redirect()->route('frontend.cart')->withMessage('Successfully submit your Band/Dj Booking data! and Item has been added to cart!');

      } else {
         return redirect()->back()->withErrors('Unable to save Band/Dj Booking. Please try again')->withInput($request->all());
      }
   }

   public function buyClassified(Request $request){
      
      if(isset( $request->page ) && $request->page > 1 )
      {
         $page = $request->page;    
      }
      else
      {
         $page = 0;  
      }

      $perPage = 6;

      $skipData = $perPage * ( $page -1);

      if( isset( $request->filter_min ) && isset( $request->filter_max ) ){

         $classifiedCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->where('products.status',1)->whereNotIn('category_id', [1,2,3,4])->whereBetween('price', [ $request->filter_min , $request->filter_max])->whereDate('products.date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        $classifiedProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->where('products.status',1)->whereNotIn('category_id', [1,2,3,4])->whereBetween('price', [ $request->filter_min , $request->filter_max])->whereDate('products.date_end','>=',date('Y-m-d'))->whereNull('deleted_at')->orderBy('id', 'desc')->skip($skipData)->take($perPage)->get();  
      }
      else{
         $classifiedCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->where('products.status',1)->whereNotIn('category_id', [1,2,3,4])->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        $classifiedProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->where('products.status',1)->whereNotIn('category_id', [1,2,3,4])->whereNull('deleted_at')->orderBy('id', 'desc')->skip($skipData)->take($perPage)->get();  
      }
      
       $totalEvent = count( $classifiedCount );
     
       $maxNumPage = ceil($totalEvent/$perPage);

      $categories         = $this->categoryService->getCategoryData();

      return view('frontend.classified.buy', compact('classifiedProducts','categories','maxNumPage','totalEvent','page','perPage','classifiedCount'));

   }

   public function sellClassified(){

      $rate       = $this->rateSettingService->getFirstRates();

      $categories = $this->categoryService->getCategoryData();

      return view('frontend.classified.sell', compact('rate','categories'));
   }

   public function sellClassifiedPost(ProductRequest $request){
      
      $response = $this->productService->saveClassifiedData($request->all());
      
      if ($response) {
         
         $this->addToCartForCharge($response,'classified_sell');

         return redirect()->route('frontend.cart')->withMessage('Successfully Post Your Classified and Item has been added to cart!');

      } else {
          return redirect()->back()->withErrors('Unable to save product. Please try again')->withInput($request->all());
      }
   }

   public function classifiedSinglePage($alias){

      $classifiedProduct = $this->productService->getProductFromAlias($alias);

      $relatedProducts   = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')
               ->whereNotIn('category_id', [1,2,3,4])
               ->where('alias', '!=', $alias)
               ->where('products.status',1)
               ->whereNull('deleted_at')
               ->whereDate('products.date_end','>=',date('Y-m-d'))
               ->get();

      return view ('frontend.classified.single-page', compact('classifiedProduct', 'relatedProducts'));

   }

   public function allClassified(){

      $classifiedProducts   = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')
               ->whereNotIn('category_id', [1,2,3,4])
               ->where('products.status',1)
               ->whereNull('deleted_at')
               ->whereDate('products.date_end','>=',date('Y-m-d'))
               ->get();

      return view ('frontend.classified.all-classified', compact('classifiedProducts'));

   }

    public function cdSinglePage($alias){
      
      $cdProduct = $this->productService->getProductFromAlias($alias);

      $relatedProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')
               ->whereIn('category_id', [1,2,3,4])
               ->where('alias', '!=', $alias)
               ->where('products.status',1)
               ->whereNull('deleted_at')
               ->get();

      return view ('frontend.cd.single-page', compact('cdProduct', 'relatedProducts'));
   }

   public function cdStore(Request $request){
      
      if(isset( $request->page ) && $request->page > 1 )
      {
         $page = $request->page;    
      }
      else
      {
         $page = 0;  
      }

      $perPage = 6;
      $skipData = $perPage * ( $page -1);
      if( isset($request->search) && isset($request->orderby) ) {
        if($request->get('orderby') == 'default'){
         $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('id', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

         $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('id', 'desc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'name_asc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'asc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'name_desc'){
            $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'desc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'price_low'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.price', 'asc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'price_high'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.price', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.price', 'desc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'model_asc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'asc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'model_desc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'desc')->whereNull('deleted_at')->where('products.status',1)->skip($skipData)->take($perPage)->get();
        }

      }
      elseif(isset($request->orderby)){

        if($request->get('orderby') == 'default'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'name_asc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'asc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'name_desc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'desc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }
        if($request->get('orderby') == 'price_low'){
         $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'asc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'price_high'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'desc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }

        if($request->get('orderby') == 'model_asc'){
         $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();

         $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'asc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }

         if($request->get('orderby') == 'model_desc'){
             $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'desc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();
        }

      }
      else{
        $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();  

        $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->skip($skipData)->take($perPage)->get();  
      }
      
      $totalEvent = count( $cdProductCount );
     
      $maxNumPage = ceil($totalEvent/$perPage);
      return view('frontend.cd.cd-store', compact('cdProducts','maxNumPage','totalEvent','page','perPage','cdProductCount'));  
   }   

   public function allCdStore(Request $request){
   
      if( isset($request->search) && isset($request->orderby) ) {
        if($request->get('orderby') == 'default'){
         $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('id', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

         $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('id', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

        if($request->get('orderby') == 'name_asc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

        if($request->get('orderby') == 'name_desc'){
            $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

        if($request->get('orderby') == 'price_low'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.name', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.price', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

        if($request->get('orderby') == 'price_high'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.price', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.price', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

        if($request->get('orderby') == 'model_asc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'asc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

        if($request->get('orderby') == 'model_desc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->where('products.name','like','%'.$request->get('search').'%')->orderBy('products.model', 'desc')->whereNull('deleted_at')->where('products.status',1)->get();
        }

      }
      elseif(isset($request->orderby)){

        if($request->get('orderby') == 'default'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();
        }

        if($request->get('orderby') == 'name_asc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();
        }

        if($request->get('orderby') == 'name_desc'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.name', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();
        }
        if($request->get('orderby') == 'price_low'){
         $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();
        }

        if($request->get('orderby') == 'price_high'){
          $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.price', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();
        }

        if($request->get('orderby') == 'model_asc'){
         $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();

         $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'asc')->where('products.status',1)->whereNull('deleted_at')->get();
        }

         if($request->get('orderby') == 'model_desc'){
             $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();

           $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('products.model', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();
        }

      }
      else{
        $cdProductCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();  

        $cdProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereIn('category_id', [1,2,3,4])->orderBy('id', 'desc')->where('products.status',1)->whereNull('deleted_at')->get();  
      }
  
      return view('frontend.cd.all-cd-store', compact('cdProducts','cdProductCount'));  
   } 

   public function cdSell(){

      $rate       = $this->rateSettingService->getFirstRates();

      $categories = $this->categoryService->getCategoryData();

      $page       = Page::where('alias','cd-sell')->first();

      return view('frontend.cd.cd-sell-content', compact('page'));

      // return view('frontend.cd.cd-sell', compact('rate','categories'));

   }   

   public function contact(){
      return view('frontend.contact');
   }

   public function contactPost(Request $request){
      
       $request = $request->all();

       $request['member_id'] = isset(authGuardData('member')->id) ?? null ;

       $contact = Contact::create($request);

       if($contact)
       {
        return redirect()->back()->withMessage('You are Successfully sent your message!');
       }
    
   }

   public function productDetail(){
      return view('frontend.product.product-detail');
   }

   public function musicianSearch(){
      $categories  = $this->memberService->getMusicCategoryData();

      return view('frontend.musician.search',compact('categories'));
   }

   public function musicianSearchResult(Request $request){
      
       DB::enableQueryLog();

       $member = new Member();

       $query  = $member->newQuery();

       $query->with('musicCategory');

      if(isset($request->first_name)){
        $query->where('first_name','LIKE','%'.$request->first_name.'%');
      }

      if(isset($request->last_name)){
        $query->where('last_name','LIKE','%'.$request->last_name.'%');
      }

      if(isset($request->music_category) && count($request->music_category) > 0 ){
      
        $query->whereHas('musicCategory', function ($q) use ($request) {
          $q->whereIn('pivot_member_music_category.music_category_id',$request->music_category);
        });
      }

      // $results = $query->where('membership_type_id',2)->where('status',1)->where('email_verified',1)->get();
      $results = $query->where('status',1)->where('email_verified',1)->get();
      // dd($results);
      return view('frontend.musician.search-reasult',compact('results'));
   }

   public function productClassifiedCategory(Request $request, $alias){

    $category = Category::where('alias',$alias)->first();

   if(isset( $request->page ) && $request->page > 1 )
   {
      $page = $request->page;    
   }
   else
   {
      $page = 0;  
   }

   $perPage = 6;

   $skipData = $perPage * ( $page -1);
   
    if( isset($request->filter_min) && isset($request->filter_max) ){

       $classifiedCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->whereBetween('price', [$request->filter_min, $request->filter_max])->where('products.status',1)->where('category_id', $category->id)->orderBy('id', 'desc')->whereNull('deleted_at')->get();

      $classifiedProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->whereBetween('price', [$request->filter_min, $request->filter_max])->where('products.status',1)->where('category_id', $category->id)->orderBy('id', 'desc')->whereNull('deleted_at')->skip($skipData)->take($perPage)->get(); 
    }

   else{
      
      $classifiedCount = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->where('products.status',1)->where('category_id', $category->id)->orderBy('id', 'desc')->whereNull('deleted_at')->get();

      $classifiedProducts = DB::table('category_product')->leftJoin('products', 'category_product.product_id', '=', 'products.id')->whereDate('products.date_end','>=',date('Y-m-d'))->where('products.status',1)->where('category_id', $category->id)->orderBy('id', 'desc')->skip($skipData)->take($perPage)->whereNull('deleted_at')->get();
   }


       $totalEvent = count( $classifiedCount );
     
       $maxNumPage = ceil($totalEvent/$perPage);
     
   $categories = $this->categoryService->getCategoryData();

   return view('frontend.classified.buy',compact('classifiedProducts','categories','category','maxNumPage','totalEvent','page','perPage','classifiedCount'));

  }

  public function classifiedService($alias)
  {
    $service = $this->productService->getProductFromAlias($alias);
    $order   = ServiceOrder::where('member_id',authGuardData('member')->id)->where('service_id',$service->id)->where('status',0)->first();
    return view('frontend.classified.service_form',compact('service','order'));
  }




  public function addToCartForCharge($data,$type){
    
    if($type == 'classified_sell'){
      $cart = new Cart();
      $cart->member_id = authGuardData('member')->id;
      $cart->type = $type;
      $cart->product_name =' Classified Sell: '.$data->name;
      $cart->price = $data->sub_total;
      $cart->quantity = 1;        
      $cart->product_id = $data->id;
      $cart->save();
    }


    if($type == 'event'){
      $cart = new Cart();
      $cart->member_id = authGuardData('member')->id;
      $cart->type = $type;
      $cart->product_name ='Event: '.$data->name;
      $cart->price = $data->sub_total;
      $cart->quantity = 1;        
      $cart->product_id = $data->id;
      $cart->save();
    }
    
    if($type == 'book_band_dj'){
      $rate = $this->rateSettingService->getFirstRates();
      $cart = new Cart();
      $cart->member_id = authGuardData('member')->id;
      $cart->type = $type;
      $cart->product_name ='Booking '.$data->type.' Submission Rate: '.$data->name;
      $cart->price = $rate->book_band_dj_submission_rate;
      $cart->quantity = 1;        
      $cart->product_id = $data->id;
      $cart->save();
    }
        
  }

  public function sellCDPost(ProductRequest $request){
      
      $response = $this->productService->saveCdData($request->all());
      
      if ($response) {
        return redirect()->back()->withMessage('Successfully Submit Your CD and wait for approving from admin!');
      } else {
          return redirect()->back()->withErrors('Unable to submit your cd. Please try again')->withInput($request->all());
      }
   }

    public function cancelClassifiedService(){
      
      $order   = ServiceOrder::where('member_id',authGuardData('member')->id)->where('status',0)->first();

      if(isset($order))
      {
        $order->delete();
        return redirect()->back()->withMessage('Successfully cancelled service!');
      }
      else
      {
           return redirect()->back()->withMessage('Successfully cancelled service!');
      }
   }

   public function voscastPage()
   {
      return  view('frontend.station-voscast');
   }

   public function memeberUpgrade($alias)
   {
    $membershipType = MembershipType::where('alias',$alias)->first();

    $membershipSetting = MembershipSettings::where('membership_type_id',$membershipType->id)->first();

    $cart            = new Cart();
    $cart->member_id = authGuardData('member')->id;
    $cart->type = 'membership';
    $cart->product_name = $membershipType->name.' signup Fee';
    $cart->member_type_id = $membershipType->id;
    $cart->price = $membershipSetting->sign_up_fee;
    $cart->quantity = 1;        
    $cart->is_upgrade = true;
    $cart->product_id = authGuardData('member')->id;
    if( $cart->save() )
    {
      return redirect()->route('frontend.cart')->withMessage('Successfully Added in cart!');
    }
   }
}
