<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $guarded = false;
    protected $table = 'companies';

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
