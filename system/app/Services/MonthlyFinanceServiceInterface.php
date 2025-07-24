<?php

namespace App\Services;

use Illuminate\Http\Request;

interface MonthlyFinanceServiceInterface
{
    public function getAllMonthlyFinances(Request $request);
    public function getMonthlyFinanceById($id);
    public function createMonthlyFinance(Request $request);
    public function updateMonthlyFinance(Request $request, $id);
    public function deleteMonthlyFinance($id);
}
