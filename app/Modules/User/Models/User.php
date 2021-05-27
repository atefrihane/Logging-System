<?php

namespace App\Modules\User\Models;

use App\Modules\Log\Models\Log;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];
    const SUPERADMIN = 1;
    const EMPLOYEE = 2;
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
    public function isAdmin()
    {
        return $this->role_id == USER::SUPERADMIN;
    }

    public function isEmployee()
    {
        return $this->role_id == USER::EMPLOYEE;
    }

    public function role()
    {
        $this->belongsTo(Role::class, 'role_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function lastLog()
    {
        return $this->belongsTo(Log::class);
    }

    public function scopeWithLastLogDate($query)
    {
        $query->addSelect(['last_log_id' => Log::select('id')
                ->whereColumn('user_id', 'users.id')
                ->latest()
                ->take(1),
        ])->with('lastLog');
    }
}
