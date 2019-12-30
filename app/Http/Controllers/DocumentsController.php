<?php

namespace App\Http\Controllers;

use App\FileType;
use App\Http\Requests\Document\StoreRequest;
use App\Http\Requests\Document\UpdateRequest;
use App\Services\DocumentService;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DocumentsController extends Controller
{
    private $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(Request $request)
    {
        if ($request->input('search')) {
            $documents = $this->documentService
                ->search($request->input('search'), 'name', [
                    'file', 'file.fileType'
                ]);
        } else {
            $documents = $this->documentService->all(['file', 'file.fileType']);
        }
        $documents = $documents->paginate(30);

        return view('admin.documents.view', [
            'documents' => $documents,
        ]);
    }

    public function create()
    {
        return view('admin.documents.create', [
            'file_types' => FileType::all()->whereIn('id', [
                FileType::DOCUMENT,
                FileType::APPLICATION_TEMPLATE,
                FileType::PROTOCOL_MEETING,
            ]),
        ]);
    }

    public function store(StoreRequest $storeRequest)
    {

        $this->documentService->create($storeRequest->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Документ добавлен!');

        return redirect(route('admin.documents.index'));
    }

    public function edit($id)
    {
        return view('admin.documents.edit', [
            'document' => $this->documentService->find($id, ['file']),
            'file_types' => FileType::all()->whereIn('id', [
                FileType::DOCUMENT,
                FileType::APPLICATION_TEMPLATE,
                FileType::PROTOCOL_MEETING,
            ]),
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {

        $this->documentService->update($id, $request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные успешно сохранены!');

        return redirect(route('admin.documents.index'));
    }

    public function destroy($id)
    {
        $this->documentService->delete($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Документ удален!');

        return redirect(route('admin.documents.index'));
    }
}
