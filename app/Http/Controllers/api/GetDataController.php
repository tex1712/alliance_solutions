<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetDatesRequest;
use App\Models\Employee;


class GetDataController extends Controller
{

    /**
     * Returns salary (with all bonuses) for given Employee
     *
     * @param Employee $employee
     * @return int
     */

    public function getSalary(Employee $employee): int
    {
        $bonus_for_orders = \EmployeeLib::getBonusForOrders($employee->id);
        $bonus_for_best = (\EmployeeLib::getBestEmployee() === $employee->id) ? 200 : 0;
        $bonus_quarter = 0;

//        Employee gets Quarter Bonus only if it's Quarter and he/she has >= constant clients
        if(\EmployeeLib::checkIfCurrentMonthIsQuarter() && \EmployeeLib::getNumberOfConstantClients($employee->id) >= 30){
            $bonus_quarter = 300;
        }

        $salary = 500 + $bonus_for_orders + $bonus_for_best + $bonus_quarter;

        return $salary;

    }


    /**
     * Returns all Company's Expenses by given period
     *
     * @param GetDatesRequest $request
     * @return int
     */
    public function getExpenses(GetDatesRequest $request): int
    {
        $from = $request->input('data.attributes.from');
        $to = $request->input('data.attributes.to');

        return \CompanyLib::getAllExpensesByPeriod($from, $to);

    }


    /**
     * Returns Company's Income by given period
     *
     * @param GetDatesRequest $request
     * @return int
     */
    public function getIncome(GetDatesRequest $request): int
    {
        $from = $request->input('data.attributes.from');
        $to = $request->input('data.attributes.to');

        return \CompanyLib::getIncome($from, $to);
    }


    /**
     * Returns Company's Profit by given period
     *
     * @param GetDatesRequest $request
     * @return int
     */
    public function getProfit(GetDatesRequest $request): int
    {
        $from = $request->input('data.attributes.from');
        $to = $request->input('data.attributes.to');

        return \CompanyLib::getIncome($from, $to) - \CompanyLib::getAllExpensesByPeriod($from, $to);
    }


}
