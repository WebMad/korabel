<?php

namespace App\Http\Controllers;

use App\FileType;
use App\Http\Requests\File\StoreImageRequest;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\ImagesNew;
use App\Services\FileService;
use App\Services\NewsService;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{

    /**
     * @var NewsService
     */
    private $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {

        if ($request->input('search')) {
            $news = $this->newsService->search($request->input('search'))->paginate(30);
        } else {
            $news = $this->newsService->all()->paginate(30);
        }

        return view('admin.news.view', ['news' => $news]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(StoreRequest $request)
    {
        $this->newsService->create($request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Новость добавлена!');

        return redirect(route('admin.news.index'));
    }

    public function edit($id)
    {
        return view('admin.news.edit', ['new' => News::findOrFail($id)]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->newsService->update($id, $request->all());

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Данные сохранены!');

        return redirect(route('admin.news.index'));
    }

    public function destroy(FileService $fileService, $id)
    {

        $this->newsService->delete($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Новость удалена!');

        return redirect(route('admin.news.index'));
    }

    /**
     * Загружает изображения для новостей
     *
     * @param StoreImageRequest $storeImageRequest
     * @param FileService $fileService
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(StoreImageRequest $storeImageRequest, FileService $fileService)
    {
        $file = $storeImageRequest->file('upload');

        $file_url = $fileService->upload($file, 'news');

        $file_db = $fileService->create([
            'url' => $file_url,
            'file_type_id' => FileType::IMAGE,
            'name' => 'картинка'
        ]);

        $pos = strrpos($file_url, '/'); //номер последнего символа "/" в строке
        $file_name = substr($file_url, $pos + 1); //название сохраненного файла

        $data = [
            'uploaded' => 1,
            'fileName' => $file_name,
            'url' => '/' . $file_url,
        ];

        ImagesNew::create([
            'img_id' => $file_db->id,
        ]);

        return response()->json($data);
    }

}
