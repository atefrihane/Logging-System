<?php

namespace App\Modules\Log\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Log\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogControllerApi extends Controller
{
    public function handleStartLog(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'integer|exists:users,id',
        ]);

        $newLog = Log::create([
            'start_date' => Carbon::now(),
            'user_id' => $request->user_id,
        ]);

        return response()->json(['log' => $newLog], 200);

    }

    public function handleEndLog(Request $request)
    {
        $request->validate([
            'log_id' => 'required|exists:logs,id',

        ]);

        $checkLog = Log::find($request->log_id);
        if (!$checkLog) {
            return response()->json([], 404);
        }
        $checkLog->update([
            'end_date' => Carbon::now(),
        ]);

        return response()->json(['log' => $checkLog], 200);

    }

    public function handleFilterLogs(Request $request)
    {
        $date = $request->date;
        $userId = $request->user_id;

        $logs = Log::when(isset($date), function ($q) use ($date) {
            $q->whereDate('created_at', $date);
        })
            ->when(isset($userId), function ($queryUser) use ($userId) {
                $queryUser->whereUserId($userId);
            })

            ->with('user')
            ->paginate(20);

        return response()->json(['logs' => $logs], 200);

    }
}
