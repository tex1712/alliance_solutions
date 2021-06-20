<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];
    /**
     * @var mixed
     */
    private $clients;


    public function clients(): HasMany
    {
        return $this->hasMany('App\Models\Client');
    }
}
