<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = [
        'lead_name',
        'company_name',
        'email',
        'phone',
        'lead_source_id',
        'status',
        'assigned_salesperson_id',
        'expected_deal_value',
        'follow_up_date',
        'notes',
    ];

    public function leadSource(): BelongsTo
    {
        return $this->belongsTo(LeadSource::class);
    }

    public function assignedSalesperson(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_salesperson_id');
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(FollowUp::class);
    }
}