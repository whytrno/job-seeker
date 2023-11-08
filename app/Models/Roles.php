<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends BaseModel
{
    use HasFactory;

    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
