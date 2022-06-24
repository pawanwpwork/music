<?php
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\MembershipType;
use App\Models\Event;
use App\Models\BookBandDj;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderProduct;
use App\Models\SiteSetting;
/**
 * To change the date format in views
 * @param $date
 * @return bool|string
 */

if (! function_exists('databaseDateFormat')){
    function databaseDateFormat($date)
    {
        if ($date) {
            $data = strtotime($date);

            return date('Y-m-d', $data);
        }

        return null;
    }
}

if (! function_exists('changeDateFormat')){
    function changeDateFormat($date)
    {
        if ($date) {
            $data = strtotime($date);

            return date('d F, Y', $data);
        }

        return null;
    }
}

/**
 * Change Date format with Time
 * @param $date
 * @return false|null|string
 */
if (! function_exists('changeDateFormatWithTime')){
    function changeDateFormatWithTime($date)
    {
        if ($date) {
            $data = strtotime($date);

            return date('d F, Y,g:i a', $data);
        }

        return null;
    }
}

/**
 * @param $start_date
 * @param $end_date
 * @return mixed
 */
if (! function_exists('dateDiff')){
    function dateDiff($start_date, $end_date)
    {
        $end_date = Carbon::parse($end_date);
        return $end_date->diffInDays(Carbon::parse($start_date));
    }
}

/**
 * @return string
 */
if (! function_exists('currentDate')){
    function currentDate()
    {
        return Carbon::now()->format('y-m-d');
    }
}

if (! function_exists('imageUploadPost')){
    function imageUploadPost($file, $folder_name)
    {   
       
        if ($file) {
            $extension =  $file->getClientOriginalExtension();
            $imageOrginalName = basename($file->getClientOriginalName(), '.' . $extension);
            return $file->storeAs($folder_name, $imageOrginalName.time().'.' . $extension);
        }     
      
        return null;
    }
}



if (! function_exists('imageUploadSvgPost')){
    function imageUploadSvgPost($file, $folder_name)
    {   
       
            if ($file) {
                $extension =  $file->getClientOriginalExtension();
                $imageOrginalName = basename($file->getClientOriginalName(), '.' . $extension);
                return $file->storeAs($folder_name, $imageOrginalName.time().'.' . $extension);
            }     
      
        return null;
    }
}

if (! function_exists('imageUploadPublic')){

    function imageUploadPublic($file, $folder_name)
    {   
       
        if ($file) {
            
            $extension =  $file->getClientOriginalExtension();

            $imageOrginalName = basename($file->getClientOriginalName(), '.' . $extension);

            $fileName = $imageOrginalName.time().'.' . $extension;

            $file->move(public_path().'/'.$folder_name, $fileName);

            return $fileName;
        }     
  
        return null;
    }
    
}
/**
 * converts ids in array to name in array
 * @param $table_name
 * @param $inputArray
 * @param $columnName
 * @return array
 */
if (! function_exists('convertIdToName')){
function convertIdToName($table_name, $inputArray, $columnName)
    {
        if ($inputArray != []) {
            $queryArray = DB::table($table_name)->pluck($columnName, 'id')->all();
            if ($queryArray != []) {
                return array_flip(array_intersect(array_flip($queryArray), $inputArray));
            }
        }

        return [];
    }
}

/**
 * converts single ids to name
 * @param $table_name
 * @param $input
 * @param $columnName
 * @param $columnKey
 * @return array
 */
if (! function_exists('convertSingleIdToName')){
    function convertSingleIdToName($table_name, $input, $columnName, $columnKey)
    {
        if ($input != null) {
            $query = DB::table($table_name)->whereId($input)
                        ->first();

            return json_decode($query->{$columnName})->{$columnKey};
        }

        return null;
    }
}

/**
 * Fetch data by table primary key Id
 * @param $tableName
 * @param $id
 * @return mixed
 */

if (! function_exists('getNameByIdOfTable')){
    function getNameByIdOfTable($tableName, $id)
    {
        return DB::table($tableName)->where('id', $id)->first();
    }    
}



/* Get User Name By Id
* @param $id
* @return mixed
*/
if (! function_exists('getUserNameById'))
{
    function getUserNameById($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return $data;
    }
}

if (! function_exists('getSliderImages'))
{
    function getSliderImages()
    {
        $data = DB::table('slider_images')->latest()->where('status', 1)->where('deleted_at', null)->get();
        return $data;
    }
}


/* Check Unique Slug By Id
* @param $slugText
* @param $tableName 
* @param $id
* @return mixed
*/

if (! function_exists('unique_slug'))
{
    function unique_slug($slugText,$tableName,$id =null) { 
        $slug = Str::slug( $slugText, '-');
        if($id){
            $slugCount = count( DB::table($tableName)->where('alias',$slug)->get() );          
            return ($slugCount > 1) ? "{$slug}-{$slugCount}" : $slug;   
        }else{
            $slugCount = count(DB::table($tableName)->whereRaw("alias REGEXP '^{$slug}(-[0-9]*)?$'")->get()); 
            return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;        
        }       
    }    
}


if (! function_exists('generateMenuOrderLists'))
{
    function generateMenuOrderLists(array $elements,$ids=null, $parentId = 0,$indent = 0) {
        $html = '';
        foreach ($elements as $key => $element) {
            if ($element['parent_id'] == $parentId) {
                    if(isset($ids->parent_id) && $ids !=null){
                        if($ids->parent_id == $element['id']){
                            $html.= '<option value="' . $element['id'] . '" selected="selected">'.$element['venue']['name'].'-';
                            $html.= str_repeat('--', $indent);
                            $html.= $element['item_name'] . '</option>' . PHP_EOL;
                        }    
                        else{
                             $html.= '<option value="' . $element['id'] . '">'.$element['venue']['name'].'-';
                        $html.= str_repeat('--', $indent);
                        $html.= $element['item_name'] . '</option>' . PHP_EOL;
                        }
                    }
                    else{
                        $html.= '<option value="' . $element['id'] . '">'.$element['venue']['name'].'-';
                        $html.= str_repeat('--', $indent);
                        $html.= $element['item_name'] . '</option>' . PHP_EOL;
                    }
                $html.= generateMenuOrderLists($elements,$ids, $element['id'],$indent + 1);
            }
            
        }
        return $html;
    }
}

if(! function_exists('authGuardData') ){
    function authGuardData($guardName){
        if(Auth::guard($guardName)->check()){
            return Auth::guard($guardName)->user();    
        }
        else{
            return 0;
        }
        
    }
}


if(! function_exists('itemByTypeHelper') ){
    function itemByTypeHelper($cart){
        if($cart->type == 'membership'){
            
            $product = Member::find($cart->product_id);

            return [
                'image' => isset($product->profile_image) ? route('frontend.member.profile',$product->id) : null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];
        }
        elseif($cart->type == 'event'){

            $product = Event::find($cart->product_id);

            return [
                'image' => isset($product->image) ? route('admin.event.storage',$product->id) : null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];

        }
        elseif($cart->type == 'book_band_dj'){

            $product = BookBandDj::find($cart->product_id);

            return [
                'image' =>  null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];

        }
        elseif($cart->type == 'classified_buy'){

            $product = Product::find($cart->product_id);

            return [
               'image' => isset($product->image) ? route('admin.product.storage',$product->id) : null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];
        }

         elseif($cart->type == 'classified_sell'){

            $product = Product::find($cart->product_id);

            return [
               'image' => isset($product->image) ? route('admin.product.storage',$product->id) : null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];
        }


        elseif($cart->type == 'cd_buy'){
            $product = Product::find($cart->product_id);

            return [
               'image' => isset($product->image) ? route('admin.product.storage',$product->id) : null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];
        }

         elseif($cart->type == 'cd_sell'){
            $product = Product::find($cart->product_id);

            return [
               'image' => isset($product->image) ? route('admin.product.storage',$product->id) : null,
                'product_name' => $cart->product_name,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'total' => $cart->price * $cart->quantity,
                'item_url' => route('frontend.cart')
            ];
        }
    }
}


if(! function_exists('getCartByMemberId') ){
    function getCartByMemberId($memberId){
    
         $cartItems = Cart::where('member_id',$memberId)->get();

         return $cartItems;
    }
}


if (! function_exists('videoUploadPost')){
    function videoUploadPost($file, $folder_name)
    {   
       
        if ($file) {
            $extension =  $file->getClientOriginalExtension();
            $imageOrginalName = basename($file->getClientOriginalName(), '.' . $extension);
            return $file->storeAs($folder_name, $imageOrginalName.time().'.' . $extension);
        }     
      
        return null;
    }
}




if(! function_exists('productDetailByTypeProductId') ){
    function productDetailByTypeProductId($order_id,$type){
        $cart = OrderProduct::find($order_id);
        if($type == 'membership'){
            
            $product = Member::find($cart->product_id);

            return [
            
                'product_name' =>  $product->first_name.' '.$product->last_name,
                'model' => $product->getMembershipType->name,
            ];
        }
        elseif($type  == 'event'){

            $product = Event::find($cart->product_id);

            return [
                'product_name' =>  $product->name,
                'model' => 'Event',
            ];

        }
        elseif($type  == 'book_band_dj'){

            $product = BookBandDj::find($cart->product_id);

            return [
                'product_name' =>  $product->name,
                'model' => 'Book Band & Dj',
            ];

        }
        elseif($type  == 'classified_buy'){

            $product = Product::find($cart->product_id);

            return [
              'product_name' =>  $product->name,
                'model' => $product->model,
            ];
        }

         elseif($type  == 'classified_sell'){

            $product = Product::find($cart->product_id);

            return [
              'product_name' =>  $product->name,
                'model' => $product->model,
            ];
        }


        elseif($type  == 'cd_buy'){
            $product = Product::find($cart->product_id);

            return [
            'product_name' =>  $product->name,
                'model' => $product->model,
            ];
        }

        elseif($type  == 'cd_sell'){
            $product = Product::find($cart->product_id);

            return [
            'product_name' =>  $product->name,
                'model' => $product->model,
            ];
        }

        elseif($type  == 'classfied_service'){
            $product = Product::find($order_id);

            return [
            'product_name' =>  $product->name,
                'model' => '',
            ];
        }
    }
}




if (! function_exists('siteSetting')){
    function siteSetting()
    {   

        $siteSetting = SiteSetting::first();

        return $siteSetting;
       
    }
}

if( ! function_exists('upgradeMemberOptions') ){
    function upgradeMemberOptions()
    {
       $types = MembershipType::where('id', '>',authGuardData('member')->membership_type_id)->get();

       return $types;
    }
}



if(! function_exists('getMemberShipPayment') ){
    function getMemberShipPayment($memberId){
    
         $cartItems = Cart::where('member_id',$memberId)->where('type','membership')->first();

         return isset( $cartItems ) ? false : true;
    }
}
