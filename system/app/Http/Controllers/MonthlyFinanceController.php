<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Income;
use App\Models\MonthlyFinance;
use App\Services\Interface\MonthlyFinanceServiceInterface;
use Illuminate\Http\Request;

class MonthlyFinanceController extends Controller
{
    protected $monthlyFinanceService, $title, $base_url;

    public function __construct(MonthlyFinanceServiceInterface $monthlyFinanceService)
    {
        $this->monthlyFinanceService = $monthlyFinanceService;
        $this->title = 'Angsuran/Pengeluaran Bulanan';
        $this->base_url = url('monthly_finances');
    }

    public function overview(Request $request)
    {
        $data['title'] = 'Overview Keuangan';
        $expenditures = Expenditure::sum('amount');
        $incomes = Income::sum('amount');
        $monthly_finances = MonthlyFinance::sum('amount');

        $paid_ids = Expenditure::whereNotNull('monthly_finance_id')
            ->whereMonth('date', now())
            ->pluck('monthly_finance_id');

        $unpaid_items = MonthlyFinance::where('billed_day', '<=', date('d'))->where('frequently', 'Monthly')
            ->whereNotIn('id', $paid_ids)
            ->get();

        $data['unpaid_items'] = $unpaid_items;
        $data['wallet'] = $incomes - $expenditures;
        return view('monthly_finances.overview', $data);
    }
    public function index(Request $request)
    {
        $data['collection'] = $this->monthlyFinanceService->getAllMonthlyFinances($request);
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('monthly_finances.index', $data);
    }

    public function add()
    {
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('monthly_finances.add', $data);
    }

    public function create(Request $request)
    {
        $result = $this->monthlyFinanceService->create($request);
        return response()->json($result);
    }

    public function show(int $id)
    {
        $result = $this->monthlyFinanceService->getMonthlyFinanceById($id);
        $data['item'] = $result['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('monthly_finances.show', $data);
    }

    public function edit(int $id)
    {
        $result = $this->monthlyFinanceService->getMonthlyFinanceById($id);
        $data['item'] = $result['data'];
        $data['title'] = $this->title;
        $data['base_url'] = $this->base_url;
        return view('monthly_finances.edit', $data);
    }

    public function update(Request $request)
    {
        $result = $this->monthlyFinanceService->update($request, $request->id);
        return response()->json($result);
    }

    public function delete(Request $request)
    {
        $result = $this->monthlyFinanceService->delete($request->id);
        return response()->json($result);
    }


    public function payBill(Request $request)
    {
        $result = $this->monthlyFinanceService->payBill($request->id);
        return response()->json($result);
    }
}
