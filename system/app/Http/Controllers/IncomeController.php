<?php

namespace App\Http\Controllers;

use App\Services\Interface\IncomeServiceInterface;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    protected $incomeService, $title, $base_url;

    public function __construct(IncomeServiceInterface $incomeService)
    {
        $this->incomeService = $incomeService;
        $this->title = 'Pemasukan';
        $this->base_url = url('incomes');
    }

    public function index(Request $request)
    {
        $data['collection'] = $this->incomeService->getAllIncomes($request);
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('incomes.index', $data);
    }

    public function add()
    {
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('incomes.add', $data);
    }

    public function create(Request $request)
    {
        $result = $this->incomeService->create($request);
        return response()->json($result);
    }

    public function show(int $id)
    {
        $result = $this->incomeService->getIncomeById($id);
        $data['item'] = $result['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('incomes.show', $data);
    }

    public function edit(int $id)
    {
        $result = $this->incomeService->getIncomeById($id);
        $data['item'] = $result['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('incomes.edit', $data);
    }

    public function update(Request $request)
    {
        $result = $this->incomeService->update($request, $request->id);
        return response()->json($result);
    }

    public function delete(Request $request)
    {
        $result = $this->incomeService->delete($request->id);
        return response()->json($result);
    }
}
