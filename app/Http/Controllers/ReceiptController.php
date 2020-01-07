<?php

namespace App\Http\Controllers;

use App\Http\Requests\Receipt\StoreRequest;
use App\Http\Requests\Receipt\UpdateRequest;
use App\Services\ReceiptService;
use App\Services\SteadService;
use App\Stead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReceiptController extends Controller
{

    private $receiptService;
    private $steadService;

    /**
     * ReceiptController constructor.
     * @param ReceiptService $receiptService
     * @param SteadService $steadService
     */
    public function __construct(ReceiptService $receiptService, SteadService $steadService)
    {
        $this->receiptService = $receiptService;
        $this->steadService = $steadService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        if (!empty($request->get('search'))) {
            $receipts = $this->receiptService->search($request->get('search'), 'steads.number', ['stead']);
        } else {
            $receipts = $this->receiptService->all(['stead', 'stead.user']);
        }
        $receipts->orderBy('receipts.id', 'desc');

        return view('admin.receipts.view', [
            'receipts' => $receipts->paginate(30),
            'months' => ReceiptService::$months,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.receipts.create');
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->only('date_receipt', 'stead_id', 'receipt_file');

        $this->receiptService->create($data);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Квитанция успешно дабавлена!');

        return back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function multipleCreate()
    {
        return view('admin.receipts.multiple_create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function multipleStore(Request $request)
    {
        $file = $request->file('receipt');

        $stead = Stead::where('number', mb_substr($file->getClientOriginalName(), 0, -4))->get()->first();
        if ($stead) {
            $this->receiptService->create([
                'stead_id' => $stead->id,
                'date_receipt' => $request->input('date_receipt'),
                'receipt_file' => $file
            ]);

            return response()->json([
                'result' => 'success',
            ]);
        } else {
            return response()->json([
                'result' => 'fail',
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $receipt = $this->receiptService->find($id);
        return view('admin.receipts.edit', [
            'receipt' => $receipt,
            'stead' => $this->steadService->find($receipt->stead_id, ['user']),
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {

        $data = $request->only('date_receipt', 'stead_id', 'receipt_file');

        $this->receiptService->update($id, $data);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Информация успешно изменена!');

        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->receiptService->delete($id);

        Session::flash('msg.status', 'success');
        Session::flash('msg.text', 'Квитанция удалена!');

        return back();
    }
}
