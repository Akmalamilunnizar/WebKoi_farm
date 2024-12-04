<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Index()
{
    // Data terbaru per bulan untuk setiap sensor
    $dataSensorPH = Sensor::selectRaw('MONTH(created_at) as bulan, ph as nilai')
        ->whereIn('id_sensor', function ($query) {
            $query->select(DB::raw('MAX(id_sensor)'))
                ->from('sensor')
                ->groupBy(DB::raw('MONTH(created_at)'));
        })
        ->orderBy('bulan')
        ->pluck('nilai');

    $dataSensorSuhu = Sensor::selectRaw('MONTH(created_at) as bulan, suhu as nilai')
        ->whereIn('id_sensor', function ($query) {
            $query->select(DB::raw('MAX(id_sensor)'))
                ->from('sensor')
                ->groupBy(DB::raw('MONTH(created_at)'));
        })
        ->orderBy('bulan')
        ->pluck('nilai');

    $dataSensorTDS = Sensor::selectRaw('MONTH(created_at) as bulan, tds as nilai')
        ->whereIn('id_sensor', function ($query) {
            $query->select(DB::raw('MAX(id_sensor)'))
                ->from('sensor')
                ->groupBy(DB::raw('MONTH(created_at)'));
        })
        ->orderBy('bulan')
        ->pluck('nilai');

    $dataBulan = Sensor::selectRaw('MONTH(created_at) as bulan')
        ->whereIn('id_sensor', function ($query) {
            $query->select(DB::raw('MAX(id_sensor)'))
                ->from('sensor')
                ->groupBy(DB::raw('MONTH(created_at)'));
        })
        ->orderBy('bulan')
        ->pluck('bulan');

    // Nilai terbaru dari setiap sensor
    $latestSensorData = Sensor::latest()->first();
    $phValue = $latestSensorData->ph ?? 0; // Default ke 0 jika tidak ada data
    $suhuValue = $latestSensorData->suhu ?? 0;
    $tdsValue = $latestSensorData->tds ?? 0;

    return view('admin.dashboard', compact(
        'dataBulan',
        'dataSensorPH',
        'dataSensorSuhu',
        'dataSensorTDS',
        'phValue',
        'suhuValue',
        'tdsValue'
    ));
}


    public function AdminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
