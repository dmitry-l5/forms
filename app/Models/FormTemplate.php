<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Answers;

class FormTemplate extends Model
{
    use HasFactory;
    public function answers():HasMany {
        return $this->hasMany(Answers::class, 'template_id', 'id');
    }
}
