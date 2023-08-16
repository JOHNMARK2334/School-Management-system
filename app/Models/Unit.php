<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable=['unit_id','name','description','course_id','year','semester','is_active'];
    /**
     * course
     * @return HasMany
     */
    public function course(): BelongsTo
    {
        return $this->hasMany(Course::class);
    }
}
