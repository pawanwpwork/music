<?php 

namespace App\Music\Services\Product;

use App\Music\Repositories\Product\ProductInterface;

class ProductService
{
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->productInterface->save($id = null, $request);
            if(auth()->user() != null){
                activity()->log(sprintf('Product created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));
            }
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create product by user : %s', auth()->user()->id));
            return null;
        }
    }

    public function getProductData()
    {
        return $this->productInterface->getProductData();
    }

    public function findAll($filters)
    {
        return $this->productInterface->findAll($filters);
    }

    public function update($id, $request)
    {
        try {
            $this->productInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Product updated successfully of Category Name: %s by user: %s',
                    getNameByIdOfTable('products', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update product of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->productInterface->delete($id);
            activity()->log(
                sprintf(
                    'Product Deleted successfully of Category Name: %s by user: %s',
                    getNameByIdOfTable('products', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to delete Category of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function find($id)
    {
        return $this->productInterface->find($id);
    }

    public function getProductFromAlias($alias)
    {
        return $this->productInterface->getProductFromAlias($alias);
    }


    public function saveCdData($request)
    {
        try {
            $response = $this->productInterface->saveCdData($request);
            if( authGuardData('member') != null ){
                activity()->log(sprintf('CD submitted successfully of id: %s by member : %s', $request['name'], authGuardData('member')->first_name));
            }
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to submit cd by member : %s', authGuardData('member')->id));
            return null;
        }
    }


     public function saveClassifiedData($request)
    {
        try {
            $response = $this->productInterface->saveClassifiedData($request);
            if( authGuardData('member') != null ){
                activity()->log(sprintf('classified submitted successfully of id: %s by member : %s', $request['name'], authGuardData('member')->first_name));
            }
            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to submit classified by member : %s', authGuardData('member')->id));
            return null;
        }
    }
}
