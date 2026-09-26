<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeadSource extends Model
{
    public function leads(): HasMany{
        return $this->hasMany(Lead::class);
    }
}
