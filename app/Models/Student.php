<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','name','photo','email','phone_number','date_of_birth','course_id','admission_year','is_active'];
    /**
     * course
     * @return BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    /**
     * Account
     * @return HasOne
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }
    /**
     * Transaction
     * @return HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
     /**
     * Notification
     * @return HasMany
     */
    public function notification(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
}
