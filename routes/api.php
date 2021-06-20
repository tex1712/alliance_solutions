<?php


use App\Http\Controllers\api\ClientEmployeeRelatedController;
use App\Http\Controllers\api\ClientEmployeeRelationshipsController;
use App\Http\Controllers\api\ClientOrdersRelatedController;
use App\Http\Controllers\api\ClientOrdersRelationshipsController;
use App\Http\Controllers\api\EmployeesClientsRelatedController;
use App\Http\Controllers\api\ExpenseController;
use App\Http\Controllers\api\GetDataController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\OrdersClientRelatedController;
use App\Http\Controllers\api\OrdersClientRelationshipsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\EmployeesClientsRelationshipsController;
use App\Http\Controllers\api\ClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Employees
Route::apiResource('/employees', EmployeeController::class);

Route::get('employees/{employee}/relationships/clients', [EmployeesClientsRelationshipsController::class, 'index'])
    ->name('employees.relationships.clients');

Route::get('employees/{employee}/clients', [EmployeesClientsRelatedController::class, 'index'])
    ->name('employees.clients');



// Clients
Route::apiResource('/clients', ClientController::class);

Route::get('clients/{client}/relationships/employees', [ClientEmployeeRelationshipsController::class, 'index'])
    ->name('clients.relationships.employees');

Route::get('clients/{client}/employees', [ClientEmployeeRelatedController::class, 'index'])
    ->name('clients.employees');

Route::get('clients/{client}/relationships/orders', [ClientOrdersRelationshipsController::class, 'index'])
    ->name('clients.relationships.orders');

Route::get('clients/{client}/orders', [ClientOrdersRelatedController::class, 'index'])
    ->name('clients.orders');


// Orders
Route::apiResource('/orders', OrderController::class);

Route::get('orders/{order}/relationships/client', [OrdersClientRelationshipsController::class, 'index'])
    ->name('orders.relationships.client');

Route::get('orders/{order}/client', [OrdersClientRelatedController::class, 'index'])
    ->name('orders.client');


// Expenses
Route::apiResource('/expenses', ExpenseController::class);


// GET DATA
Route::get('get/salary/employee/{employee}', [GetDataController::class, 'getSalary'])
    ->name('get.salary');

Route::post('get/expenses', [GetDataController::class, 'getExpenses'])
    ->name('get.expenses');

Route::post('get/income', [GetDataController::class, 'getIncome'])
    ->name('get.income');

Route::post('get/profit', [GetDataController::class, 'getProfit'])
    ->name('get.profit');






