<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\MonthlyFinance;
use App\Services\Interface\ExpenditureServiceInterface;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    protected $expenditureService, $title, $base_url;

    public function __construct(ExpenditureServiceInterface $expenditureService)
    {
        $this->expenditureService = $expenditureService;
        $this->title = 'Pengeluaran';
        $this->base_url = url('expenditures');
    }

    public function index(Request $request)
    {
        $data['collection'] = $this->expenditureService->getAllExpenditures($request);
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('expenditures.index', $data);
    }

    public function add()
    {
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        $data['wishlists'] = Wishlist::all();
        $data['monthlyFinances'] = MonthlyFinance::all();
        return view('expenditures.add', $data);
    }

    public function create(Request $request)
    {
        $result = $this->expenditureService->create($request);
        return response()->json($result);
    }

    public function show(int $id)
    {
        $result = $this->expenditureService->getExpenditureById($id);
        $data['item'] = $result['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('expenditures.show', $data);
    }

    public function edit(int $id)
    {
        $result = $this->expenditureService->getExpenditureById($id);
        $data['item'] = $result['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        $data['wishlists'] = Wishlist::all();
        $data['monthlyFinances'] = MonthlyFinance::all();
        return view('expenditures.edit', $data);
    }

    public function update(Request $request)
    {
        $result = $this->expenditureService->update($request, $request->id);
        return response()->json($result);
    }

    public function delete(Request $request)
    {
        $result = $this->expenditureService->delete($request->id);
        return response()->json($result);
    }
}
