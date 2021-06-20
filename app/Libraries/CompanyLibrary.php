<?php


namespace App\Libraries;


use App\Models\Employee;
use App\Models\Expense;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CompanyLibrary
{

    /**
     * Returns expenses of the Company for chosen period
     *
     * @param string $from
     * @param string $to
     * @return int
     */
    public function getAllExpensesByPeriod(string $from, string $to){
        $from_date = Carbon::create($from);
        $to_date = Carbon::create($to);

//        Get salary of all employees for period
        $salary = 0;
//        If $from date isn't the first day of the month then count salary from the following month or return 0 if $to_date is the same month
        $firstDay = Carbon::create($from)->startOfMonth();
        if($from_date->format('m') == $to_date->format('m') && $from_date != $firstDay){
            $salary = 0;
        }
        elseif($from_date != $firstDay){
            $next_month = $from_date->addMonth()->startOfMonth();
            $salary = $this->getSalaryByPeriod($next_month, $to_date->startOfMonth());
        }
        else {
            $salary = $this->getSalaryByPeriod($from_date, $to_date->startOfMonth());
        }


//        Get all additional expenses
        $expenses_total = 0;
        $expenses = Expense::whereBetween('date', [$from, $to])->get();
        foreach ($expenses as $expense){
            $expenses_total += $expense->total;
        }


        return $salary + $expenses_total;
    }


    /**
     * Returns salary for all Employees for given period
     *
     * @param $from Carbon
     * @param $to Carbon
     * @return int
     */
    public function getSalaryByPeriod(Carbon $from, Carbon $to){
        $salary = 0;
        $bonus_orders = 0;
        $best_seller = 0;
        $bonus_constant_clients = 0;
        $number_of_months = 0;

//        Count all bonuses for orders (bonus is always payed for privious month)
        if($from == $to){
            $date = Carbon::instance($from)->subMonth();
            $orders = Order::whereYear('date', $date->year)->whereMonth('date', $date->month)->get();
        }
        else {
            $orders = Order::whereBetween('date', [$from->subMonth(), $to->subMonth()->endOfMonth()])->get();
        }
        foreach ($orders as $order){
            $bonus_orders += $order->total * 0.03;
        }


//        Count salary and bonuses to best seller
        foreach (CarbonPeriod::create($from, '1 month', $to) as $month) {
            $best_seller += 200;

            foreach (Employee::all() as $employee){
                $salary += 500;
            }
            $number_of_months++;
        }


//        Count bonuses for constant clients (I don't take into account when order was created)
        $number_of_employees_with_constant_clients = 0;
        foreach (Employee::all() as $employee){
            if(\EmployeeLib::getNumberOfConstantClients($employee->id) >= 30){
                $number_of_employees_with_constant_clients++;
            }
        }
        $number_of_bonuses_for_constant_client = intval($number_of_months / 3);
        $bonus_constant_clients = $number_of_bonuses_for_constant_client * $number_of_employees_with_constant_clients * 300;


        return $salary + $bonus_orders + $best_seller + $bonus_constant_clients;

    }


    /**
     * Returns Income of the Company for given period
     *
     * @param string $from
     * @param string $to
     *
     * @return int
     */
    public function getIncome(string $from, string $to): int
    {
        $orders = Order::whereBetween('date', [Carbon::create($from), Carbon::create($to)])->get();

        $income = 0;
        foreach ($orders as $order){
            $income += $order->total;
        }

       return $income;
    }

}
