<?php 

namespace App\Music\Services\Category;

use App\Music\Repositories\Category\CategoryInterface;

class CategoryService
{
    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->categoryInterface->save($id = null, $request);
            activity()->log(sprintf('Category  created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Category by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getCategoryData()
    {
        return $this->categoryInterface->getCategoryData();
    }

    public function update($id, $request)
    {
        try {
            $this->categoryInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Category updated successfully of Category Name: %s by user: %s',
                    getNameByIdOfTable('categories', $id)->name,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );

            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update Category of id : %s by user : %s', $id, auth()->user()->id));

            return null;
        }
    }

    public function delete($id)
    {
        try {
            $this->categoryInterface->delete($id);
            activity()->log(
                sprintf(
                    'Category Deleted successfully of Category Name: %s by user: %s',
                    getNameByIdOfTable('categories', $id)->name,
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
        return $this->categoryInterface->find($id);
    }
}
