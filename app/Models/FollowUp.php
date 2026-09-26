<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUp extends Model
{
    protected $fillable = [
        'lead_id',
        'follow_up_date',
        'notes',
        'created_by',
    ];


public function lead(): BelongsTo
{
    return $this->belongsTo(Lead::class);
}

public function creator(): BelongsTo
{
    return $this->belongsTo(User::class, 'created_by');
}


}