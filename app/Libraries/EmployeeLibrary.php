<?php


namespace App\Libraries;

use App\Models\Employee;
use Carbon\Carbon;

class EmployeeLibrary
{

    /**
     * Returns amount of bonus (for orders) by Employee for CURRENT MONTH
     *
     * @param integer $employee_id
     * @return integer
     */

    public function getBonusForOrders(int $employee_id): int
    {
        $orders = $this->getOrdersByEmployee($employee_id, 'current');
        $totalSum = 0;
        $bonus = 0;

        if(!empty($orders)){
            foreach ($orders as $order){
                $totalSum += $order->total;
            }
        }

        if($totalSum !== 0){
            $bonus = $totalSum * 0.03;
        }

        return $bonus;
    }


    /**
     * Returns all orders by Employee for Current Month | All Period
     *
     * @param integer $employee_id
     * @param string $period
     * @return array
     */
    public function getOrdersByEmployee(int $employee_id, string $period = 'all'): array
    {
        $clients = Employee::find($employee_id)->clients;
        $orders = [];
        if($clients->isNotEmpty()){
            foreach ($clients as $client){
                if($client->orders->isNotEmpty()){
                    if($period == 'current'){
                        $previous_month = Carbon::now()->startOfMonth()->subMonth()->format('m');
                        foreach ($client->orders as $order){
                            $order_month = Carbon::create($order->date)->format('m');
                            if($order_month == $previous_month){
                                $orders[] = $order;
                            }
                        }
                    }
                    else {
                        foreach ($client->orders as $order){
                                $orders[] = $order;
                        }
                    }
                }
            }
        }
        return $orders;
    }


    /**
     * Returns the best Employee of the month
     *
     * @return int|null
     */

    public function getBestEmployee(){
        $employees = Employee::all();
        $bonus = 0;
        $best_employee = null;

        foreach ($employees as $employee){
            $employee_bonus = $this->getBonusForOrders($employee->id);

            if($employee_bonus > $bonus){
                $bonus = $employee_bonus;
                $best_employee = $employee->id;
            }
        }

        return $best_employee;
    }



    /**
     * Returns number of Constant Clients by Employee
     *
     * @return int|null
     */
    public function getNumberOfConstantClients($employee_id): ?int
    {
        $orders = $this->getOrdersByEmployee($employee_id);
        $clients = [];
        $constant_clients = 0;

        foreach ($orders as $order){
            $clients[] = $order->client_id;
        }
        $duplicates = array_count_values($clients);


        foreach($duplicates as $item){
            if($item > 1){
                $constant_clients++;
            }
        }

        return $constant_clients;

    }


    /**
     * Checks if current month is Quarter
     *
     * @return bool
     */
    public function checkIfCurrentMonthIsQuarter(): bool
    {
        $current_month = \Carbon\Carbon::now()->month;
        $quarter = $current_month/3;

        return is_int($quarter);

    }

}
