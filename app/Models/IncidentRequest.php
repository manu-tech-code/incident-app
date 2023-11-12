<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'caller',
        'opened',
        'opened_by',
        'location',
        'impacted_item',
        'category',
        'priority',
        'short_description',
        'description',
        'it_personnel_id',
        'incident_state',
        'remarks'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
