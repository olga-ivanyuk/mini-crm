<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $guarded = false;
    protected $table = 'companies';

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    protected static function booted(): void
    {
        static::deleting(function ($company) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
        });
    }
}
