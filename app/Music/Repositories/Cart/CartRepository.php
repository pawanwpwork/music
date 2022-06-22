<?php 
namespace App\Music\Repositories\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartInterface
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function addToCart($request)
    {
        $request['member_id'] =  authGuardData('member')->id;
        
        
        $cart                 = $this->cart->create($request);

        return $cart;
    }
}
