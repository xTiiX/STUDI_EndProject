<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'is_active',
        'short_desc',
        'full_desc',
        'logo_url',
        'dpo',
        'technical_contact',
        'commercial_contact',
        'user_id',
    ];

    public function linkUser() {
        return User::withTrashed()->where('id', $this->user_id);
    }
}
