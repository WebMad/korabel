<?php

namespace App\Services;

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

    public function __construct(Receipt $receipt)
    {
        parent::__construct($receipt);
    }

    public function create($params)
    {
        $file = $params['receipt_file'];
        $params['file'] = $this->uploadReceipt($file);;

        return $this->model::create($params);
    }

    public function delete($id)
    {
        $receipt = $this->find($id);

        $filePath = public_path($receipt->file);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $receipt->delete();
    }

    public function update($id, $params)
    {
        $receipt = $this->find($id);

        if (!empty($params['receipt_file'])) {
            $filePath = public_path($receipt->file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $params['file'] = $this->uploadReceipt($params['receipt_file']);
        }
        $receipt->update($params);
    }

    public function uploadReceipt($file)
    {
        $destination_path = 'storage/uploads/receipts';
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($destination_path), $file_name);
        return $destination_path . '/' . $file_name;
    }

    public function search($search, $column, $relations = [])
    {
        return $this->all($relations)->whereHas('stead', function ($query) use ($search, $column) {
            $query->where($column, 'LIKE', "%$search%");
        });
    }
}
