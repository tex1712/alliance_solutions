<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\ExpensesCollection;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ExpensesCollection
     */
    public function index(): ExpensesCollection
    {
        $expense = QueryBuilder::for(Expense::class)->allowedSorts([
            'name',
            'total',
            'date',
            'created_at',
            'updated_at'
        ])->jsonPaginate();
        return new ExpensesCollection($expense);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateExpenseRequest $request
     * @return JsonResponse
     */
    public function store(CreateExpenseRequest $request): JsonResponse
    {
        $expense = Expense::create([
            'name' => $request->input('data.attributes.name'),
            'total' => $request->input('data.attributes.total'),
            'date' => $request->input('data.attributes.date')
        ]);

        return (new ExpenseResource($expense))
            ->response()
            ->header('Location', route('expenses.show', ['expense' => $expense]));
    }

    /**
     * Display the specified resource.
     *
     * @param Expense $expenses
     * @return ExpensesResource
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExpenseRequest $request
     * @param Expense $expense
     * @return ExpenseResource
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): ExpenseResource
    {
        $expense->update($request->input('data.attributes'));
        return new ExpenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Expense $expense
     * @return Response
     */
    public function destroy(Expense $expense): Response
    {
        $expense->delete();
        return response(null, 204);
    }
}
