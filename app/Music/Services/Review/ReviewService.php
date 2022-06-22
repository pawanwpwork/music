<?php 

namespace App\Music\Services\Review;

use App\Music\Repositories\Review\ReviewInterface;

class ReviewService
{
    public function __construct(ReviewInterface $reviewInterface)
    {
        $this->reviewInterface = $reviewInterface;
    }

    public function save($request)
    {
        try {
            $response = $this->reviewInterface->save($id = null, $request);
            activity()->log(sprintf('Review created successfully of id: %s by user : %s', $request['name'], getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Review by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getReviewData()
    {
        return $this->reviewInterface->getReviewData();
    }

    public function update($id, $request)
    {
        try {
            $this->reviewInterface->save($id, $request);
            activity()->log(
                sprintf(
                    'Review updated successfully : %s by user: %s',
                    getNameByIdOfTable('product_reviews', $id)->member_id,
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
            $this->reviewInterface->delete($id);
            activity()->log(
                sprintf(
                    'Review Deleted successfully : %s by user: %s',
                    getNameByIdOfTable('product_reviews', $id)->member_id,
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
        return $this->reviewInterface->find($id);
    }


    public function changeStatus($id)
    {
        try {
            $this->reviewInterface->changeStatus($id);
            activity()->log(
                sprintf(
                    'Review status successfully updated : %s by user: %s',
                    getNameByIdOfTable('product_reviews', $id)->member_id,
                    getUserNameById(auth()->user()->id)->first_name
                )
            );
            return true;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to update review status of id : %s by user : %s', $id, auth()->user()->id));
            return null;
        }
    }
}
