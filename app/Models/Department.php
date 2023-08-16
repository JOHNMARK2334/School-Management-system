<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
        protected $fillable = ['name','short_name','department_head','description','is_active'];

    /**
     * staff
     * @return HasMany
     */
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class);
    }

    /**
     * course
     * @return HasMany
     */
    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
    
}
