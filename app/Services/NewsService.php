<?php

namespace App\Services;

use App\ImagesNew;
use App\News;

/**
 * Class NewsService
 * @property News $model
 * @package App\Http\Services
 */
class NewsService extends BaseService
{

    private $fileService;

    public function __construct(News $news, FileService $fileService)
    {
        $this->fileService = $fileService;
        parent::__construct($news);
    }

    public function create($params)
    {
        $new = parent::create($params);

        $images = $this->getImagesFromText($params['content']);

        if ($images) {
            ImagesNew::whereHas('file', function ($query) use ($images  ) {
                $query->whereIn('url', $images);
            })->update(['new_id' => $new->id]);
        }

        $files_to_delete = $this->fileService->model::whereHas('imagesNew', function ($query) {
            $query->whereNull('new_id');
        })->whereNotIn('url', $images)->get();

        foreach ($files_to_delete as $file_to_delete) {
            $file_to_delete->imagesNew()->delete();
            $this->fileService->delete($file_to_delete->id);
        }
    }

    public function update($id, $params)
    {
        $new = $this->find($id);

        $last_images = $this->getImagesFromText($new->content);
        $new_images = $this->getImagesFromText($params['content']);

        parent::update($id, $params);

        $images_to_add = array_diff($new_images, $last_images);
        $images_to_delete = array_diff($last_images, $new_images);

        if ($images_to_add) {
            ImagesNew::whereHas('file', function ($query) use ($images_to_add) {
                $query->whereIn('url', $images_to_add);
            })->update(['new_id' => $new->id]);
        }

        if ($images_to_delete) {
            $files_to_delete = $this->fileService->model::whereHas('imagesNew', function ($query) use ($new) {
                $query->where('new_id', $new->id);
            })->get();

            foreach ($files_to_delete as $file_to_delete) {
                $this->fileService->delete($file_to_delete->id);
            }
        }

        $files_to_delete = $this->fileService->model::whereHas('imagesNew', function ($query) {
            $query->whereNull('new_id');
        })->get();

        foreach ($files_to_delete as $file_to_delete) {
            $this->fileService->delete($file_to_delete->id);
        }
    }

    public function delete($id)
    {
        $files = $this->fileService->model::whereHas('imagesNew', function ($query) use ($id) {
            $query->where('new_id', $id);
        })->get();
        foreach ($files as $file) {
            $this->fileService->delete($file->id);
        }
        parent::delete($id);
    }

    public function search($search, $relations = [])
    {
        return $this->all($relations)->where('header', 'LIKE', '%' . $search . '%');
    }

    public function getImagesFromText($text)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($text);

        $images = $dom->getElementsByTagName("img");

        $images_send = [];
        foreach ($images as $image) {
            if (substr($image->getAttribute('src'), 0, 4) !== 'http') {
                $images_send[] = substr($image->getAttribute('src'), 1);
            }
        }

        return $images_send;
    }

}
