<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Partner;

class Structure extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'adress',
        'phone',
        'logo_url',
        'partner_id'
    ];

    public function linkPartner() {
        return Partner::withTrashed()->where('id', $this->partner_id);
    }

}
