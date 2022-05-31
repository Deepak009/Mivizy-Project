<?php

namespace App\Http\Controllers;

use App\Models\BloodDonor;
use App\Models\BloodRequest;
use App\Models\DietChart;
use App\Models\User;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function data()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            $data['total_customer'] = Customer::select('id')->count();
            $data['blood_donors'] = BloodDonor::select('id')->count();
            $data['current_customer'] = Customer::select('id')->where(
                'created_at',
                '>=',
                Carbon::now()->subMonth()->toDateTimeString()
            )->count();
            $data['blood_request'] = BloodRequest::select('id')->where(
                'created_at',
                '>=',
                Carbon::now()->subMonth()->toDateTimeString()
            )->count();
        } elseif ($user->is_dietician) {
            $data['diet_chart_last_month'] = DietChart::select('id')->whereBetween(
                DB::raw('date(created_at)'),
                [
                    Carbon::now()->subMonth()->startOfMonth()->toDateTimeString(),
                    Carbon::now()->subMonth()->endOfMonth()->toDateTimeString(),
                ]
            )->where('dietician_id', $user->id)->count();
            $data['diet_chart_current_month'] = DietChart::select('id')->where(
                'created_at',
                '>=',
                Carbon::now()->firstOfMonth()->toDateTimeString()
            )->where('dietician_id', $user->id)->count();
            $data['diet_chart_pending'] = DietChart::select('id')->where(
                'created_at',
                '>=',
                Carbon::now()->firstOfMonth()->toDateTimeString()
            )->whereNull('dietician_id')->count();
        }

        return response()->json($data);
    }
}
