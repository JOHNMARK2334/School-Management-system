<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['course_id','name','short_name','number','description','fee_total','duration','department_id','category_id','is_active'];

    /**
     * department
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * unit
     * @return HasMany
     */
    public function unit(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * student
     * @return HasMany
     */
    public function student(): HasMany
    {
        return $this->hasMany(Student::class, 'course_id')->latest();
    }

    /**
     * category
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
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
