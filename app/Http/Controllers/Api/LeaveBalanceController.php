<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveBalance;

class LeaveBalanceController extends Controller
{
    public function myBalances(Request $request)
    {
        $currentYear = now()->year;

        $balances = LeaveBalance::with('leaveType')
            ->where('user_id', $request->user()->id)
            ->where('year', $currentYear)
            ->get();

        return response()->json($balances);
    }
}
