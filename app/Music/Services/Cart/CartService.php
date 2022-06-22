<?php 

namespace App\Music\Services\Cart;

use App\Music\Repositories\Cart\CartInterface;

class CartService
{
    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function addToCartForMember($request){
        try{
            $response = $this->cart->addToCartForMember($request);

            activity()->log(sprintf('Membership Register added in cart successfully of id: %s by user : %s', authGuardData('member')->first_name, authGuardData('member')->first_name));

            return $response;

        } catch (\Exception $e){

            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to add Membership Register in cart by user : %s', authGuardData('member')->id));

        }
    }


    // public function save($request)
    // {
    //     try {
    //         $response = $this->cart->save($id = null, $request);
    //         activity()->log(sprintf('Member Photo created successfully of id: %s by user : %s', authGuardData('member')->first_name, authGuardData('member')->first_name));

    //         return $response;
    //     } catch (\Exception $e) {
    //         activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Member Photo by user : %s', authGuardData('member')->id));

    //         return null;
    //     }
    // }

    // public function update($id, $request)
    // {
    //     try {
    //         $this->cart->save($id, $request);
    //         activity()->log(
    //             sprintf(
    //                 'Membership Photo updated successfully :by user: %s',
    //                 '',
    //                 authGuardData('member')->first_name
    //             )
    //         );

    //         return true;
    //     } catch (\Exception $e) {
    //         activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Member Photo of id : %s by user : %s', $id, authGuardData('member')->id));

    //         return null;
    //     }
    // }

    // public function find($id){
    //     $photo = $this->cart->find($id);
    //     return $photo;
    // }
}
