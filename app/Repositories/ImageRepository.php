<?php


namespace Mango\Repositories;

use App\Models\Image;
use Mango\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ImageRepository extends BaseRepository
{

    private $foundIds;
    public function create(array $data)
    {
        try {

            $validator = Validator::make($data, 
                [
                    'image' => 'required|mimes:jpg,png|max:5048',
                    'parent_type' => [
                        'required',
                        Rule::in(['product', 'product_item']),
                    ],
                    'parent_id' => 'required|int',
                ]
            );

            if ($validator->fails()) throw new \Exception('Data types mismatch');
            $data = $validator->validated();

            $file = $data['image'];
            $path = $file->store($this->createStorePath($data['parent_type'], $data['parent_id']), 'public');
            $data['path'] = $path;

            $image = Image::create($data);
            return $image;

        } catch (\Exception $e) {
            info($e);
            return abort(500, $e->getMessage());
        }
    }

    public function delete(int $id)
    {
        try {
            $image = Image::find($id);
            if ( ! $image) throw new \Exception('Image not found');
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }


    public function createStorePath(string $parent_type, int $id): string 
    {
        $path = 'uploads/';
        $path .= $parent_type . '/' . $id;
        return $path;
    }
    
}