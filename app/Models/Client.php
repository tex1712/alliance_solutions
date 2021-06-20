<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'employee_id'];
    /**
     * @var mixed
     */
    private $employee;
    private $orders;


    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Models\Employee');
    }

    public function orders(): HasMany
    {
        return $this->hasMany('App\Models\Order');
    }
}
