<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $fillable=['amount'];

    /**
     * Student
     * @return HasMany
     */
    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }
    /**
     * Transaction
     * @return HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
