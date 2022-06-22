<?php 
namespace App\Music\Repositories\Review;

use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Storage;

class ReviewRepository implements ReviewInterface
{
    protected $review;

    public function __construct(ProductReview $review)
    {
        $this->review = $review;
    }

    public function save($id, $request)
    {
        if ($id) {
            $review                = $this->find($id);
            $request["updated_by"] = auth()->user()->id;
            $request['alias']      = unique_slug($request['title'],'reviews',$review->id);
            return $review->update($request);
        }
        $request["created_by"] = auth()->user()->id;
        $request['alias']      = unique_slug($request['title'],'reviews');
        $review                = $this->review->create($request);

        return $review;
    }

    public function find($id)
    {
        return $this->review->findOrFail($id);
    }

    public function getreviewData()
    {
        $review = $this->review->get();
        return $review;
    }

    public function delete($id)
    {
        $review = $this->find($id);

        return $review->delete();
    }

    public function changeStatus($id)
    {
        $review = $this->find($id);
        if($review->status == 0)
        {
            $review->status = 1;
        }
        else
        {
            $review->status = 0;
        }
        return $review->save();
    }
}
