<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'advocated_content_id',
        'full_name',
        'email',
        'phone',
        'current_location',
        'years_experience',
        'linkedin_url',
        'resume_path',
        'cover_letter',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'years_experience' => 'integer',
        ];
    }

    public function career(): BelongsTo
    {
        return $this->belongsTo(AdvocatedContent::class, 'advocated_content_id');
    }
}
