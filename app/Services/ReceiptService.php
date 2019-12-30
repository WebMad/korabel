<?php

namespace App\Services;

use App\FileType;
use App\Receipt;
use App\Stead;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class ReceiptService
 * @property Receipt $model
 * @package App\Http\Services
 */
class ReceiptService extends BaseService
{

    static $months = [
        'январь',
        'февраль',
        'март',
        'апрель',
        'май',
        'июнь',
        'июль',
        'август',
        'сентябрь',
        'октябрь',
        'ноябрь',
        'декабрь'
    ];

    private $fileService;

    public function __construct(Receipt $receipt, FileService $fileService)
    {
        $this->fileService = $fileService;
        parent::__construct($receipt);
    }

    public function create($params)
    {
        $file = $params['receipt_file'];
        $file_url = $this->fileService->upload($file, 'receipts');
        $file_db = $this->fileService->create([
            'name' => 'квитанция',
            'url' => $file_url,
            'file_type_id' => FileType::RECEIPT
        ]);
        $params['file_id'] = $file_db->id;

        return $this->model::create($params);
    }

    public function delete($id)
    {
        $receipt = $this->find($id);
        if ($receipt->file_id) {
            $this->fileService->delete($receipt->file_id);
        }
        parent::delete($id);
    }

    public function update($id, $params)
    {
        $receipt = $this->find($id);

        if (!empty($params['receipt_file'])) {
            $this->fileService->delete($receipt->file->id);
            $file_url = $this->fileService->upload($params['receipt_file'], 'receipts');
            $file = $this->fileService->create([
                'name' => 'квитанция',
                'url' => $file_url,
                'file_type_id' => FileType::RECEIPT,
            ]);
            $params['file_id'] = $file->id;
        }
        $receipt->update($params);
    }

    public function search($search, $column, $relations = [])
    {
        return $this->all($relations)->whereHas('stead', function ($query) use ($search, $column) {
            $query->where($column, 'LIKE', "%$search%");
        });
    }
}
