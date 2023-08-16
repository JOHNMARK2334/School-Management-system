<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','department_id','is_active'];
    /**
     * staff
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
