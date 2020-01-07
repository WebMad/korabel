<?php

namespace App\Services;

use App\Files;
use App\FileType;
use App\Receipt;
use Illuminate\Support\Facades\File;

/**
 * Class FileService
 * @property Receipt $model
 * @package App\Http\Services
 */
class FileService extends BaseService
{

    public function __construct(Files $files)
    {
        parent::__construct($files);
    }

    public function upload($file, $dir)
    {
        $destination_path = 'storage/uploads/' . $dir;
        $file_name = str_replace('.', '-', microtime(true)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($destination_path), $file_name);

        return $destination_path . '/' . $file_name;
    }

    public function deleteFile($url)
    {
        if (File::exists(public_path($url))) {
            File::delete(public_path($url));
        }
    }

    public function delete($id)
    {
        $file = $this->find($id);
        $this->deleteFile($file->url);
        $file->delete();
    }

}
