<?php

namespace App\Models;

use App\Enums\EmploymentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'location',
        'employment_type',
        'department',
        'description',
        'requirements',
        'benefits',
        'salary_range',
        'is_active',
        'application_deadline',
    ];

    protected function casts(): array
    {
        return [
            'employment_type' => EmploymentType::class,
            'is_active' => 'boolean',
            'application_deadline' => 'date',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
