<?php

namespace App\Modules\General\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{

    public function showHome()
    {
        $authenticatedUser = Auth::user();
        $employees = [];

        if ($authenticatedUser->isEmployee()) {
            //If the current logged in user is an employee :
            //load current day log time
            $authenticatedUser->load(['logs' => function ($query) {
                $query->whereDate('created_at', Carbon::today())->first();
            }]);

        }
        if ($authenticatedUser->isAdmin()) {
            //If the current logged in user is an admin :
            //load employees for filter purposes
            $employees = User::whereRoleId(USER::EMPLOYEE)->get();
        }

        return view('General::showHome', [
            'user' => $authenticatedUser,
            'employees' => $employees,
        ]);

    }
}
