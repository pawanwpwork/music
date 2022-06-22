<?php 

namespace App\Music\Services\SliderImage;

use App\Music\Repositories\SliderImage\SliderImageInterface;

class SliderImageService
{
    public function __construct(SliderImageInterface $sliderImage)
    {
        $this->sliderImage = $sliderImage;
    }

    public function save($request)
    {
        try {
            $response = $this->sliderImage->save($id = null, $request);
            activity()->log(sprintf('Slider image created successfully of id: %s by user : %s', auth()->user()->first_name, getUserNameById(auth()->user()->id)->first_name));

            return $response;
        } catch (\Exception $e) {
            activity()->withProperties(['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()])->log(sprintf('Unable to create Slider image by user : %s', auth()->user()->id));

            return null;
        }
    }

    public function getSiteData()
    {
        return $this->sliderImage->getSiteData();
    }

    public function update($id, $request)
    {
        try {
            $this->sliderImage->save($id, $request);
            activity()->log(
                sprintf(
                    'Slider image updated successfully : %s by user: %s',
                    getNameByIdOfTable('slider_images', $id)->id,
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
            $this->sliderImage->delete($id);
            activity()->log(
                sprintf(
                    'Slider image Deleted successfully : %s by user: %s',
                    getNameByIdOfTable('slider_images', $id)->id,
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
        return $this->sliderImage->find($id);
    }
}
