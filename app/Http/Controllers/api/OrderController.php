<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersCollection;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return OrdersCollection
     */
    public function index(): OrdersCollection
    {
        $orders = QueryBuilder::for(Order::class)->allowedSorts([
            'name',
            'total',
            'created_at',
            'updated_at'
        ])->jsonPaginate();
        return new OrdersCollection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrderRequest $request): JsonResponse
    {
        $order = Order::create([
            'name' => $request->input('data.attributes.name'),
            'total' => $request->input('data.attributes.total'),
            'client_id' => $request->input('data.attributes.client_id'),
            'date' => $request->input('data.attributes.date')
        ]);

        return (new OrderResource($order))
            ->response()
            ->header('Location', route('orders.show', ['order' => $order]));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order $order
     * @return OrderResource
     */
    public function update(UpdateOrderRequest $request, Order $order): OrderResource
    {
        $order->update($request->input('data.attributes'));
        return new OrderResource($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return Response
     */
    public function destroy(Order $order): Response
    {
        $order->delete();
        return response(null, 204);
    }
}
