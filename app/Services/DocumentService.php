<?php

namespace App\Services;

use App\Documents;

/**
 * Class DocumentService
 * @property Documents $model
 * @package App\Http\Services
 */
class DocumentService extends BaseService
{

    private $fileService;

    public function __construct(Documents $documents, FileService $fileService)
    {
        $this->fileService = $fileService;
        parent::__construct($documents);
    }

    public function create($params)
    {
        $file_url = $this->fileService->upload($params['file'], 'documents');
        $file = $this->fileService->create([
            'name' => $params['name'],
            'file_type_id' => $params['type'],
            'url' => $file_url,
        ]);

        parent::create([
            'file_id' => $file->id,
        ]);
    }

    public function update($id, $params)
    {
        $document = $this->find($id, ['file']);
        $data = [
            'name' => $params['name'],
            'file_type_id' => $params['type'],
        ];
        if (!empty($params['file'])) {
            $this->fileService->deleteFile($document->file->url);
            $file_url = $this->fileService->upload($params['file'], 'documents');
            $data['url'] = $file_url;
        }

        $this->fileService->update($document->file_id, $data);
    }

    public function delete($id)
    {
        $document = $this->find($id, ['file']);
        $this->fileService->delete($document->file_id);
    }

    public function search($search, $column, $relations = [])
    {
        return $this->all($relations)->whereHas('file', function ($query) use ($search, $column) {
            $query->where($column, 'LIKE', "%$search%");
        });
    }

}
