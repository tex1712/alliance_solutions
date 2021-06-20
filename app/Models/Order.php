<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'total', 'client_id'];
    /**
     * @var mixed
     */
    private $client;


    public function client(): BelongsTo
    {
        return $this->belongsTo('App\Models\Client');
    }
}
