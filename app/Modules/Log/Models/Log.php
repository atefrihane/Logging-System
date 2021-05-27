<?php

namespace App\Modules\Log\Models;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
