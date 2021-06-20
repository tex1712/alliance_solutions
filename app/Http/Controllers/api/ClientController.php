<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ClientsCollection;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ClientsCollection
     */
    public function index(): ClientsCollection
    {
        $clients = QueryBuilder::for(Client::class)->allowedSorts([
            'name',
            'created_at',
            'updated_at'
        ])->jsonPaginate();
        return new ClientsCollection($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(CreateClientRequest $request): JsonResponse
    {
        $client = Client::create([
            'name' => $request->input('data.attributes.name'),
            'employee_id' => $request->input('data.attributes.employee_id')
        ]);

        return (new ClientResource($client))
            ->response()
            ->header('Location', route('clients.show', ['client' => $client]));
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client): ClientResource
    {
        return new ClientResource($client);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Client $client
     * @return ClientResource
     */
    public function update(UpdateClientRequest $request, Client $client): ClientResource
    {
        $client->update($request->input('data.attributes'));
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Client $client
     * @return Response
     */
    public function destroy(Client $client): Response
    {
        $client->delete();
        return response(null, 204);
    }
}
