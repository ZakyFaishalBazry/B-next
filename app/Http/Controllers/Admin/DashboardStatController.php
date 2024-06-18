<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardStatController extends Controller
{
    public function index()
    { {
            $totalAppointmentsCount = Appointment::query()
                ->when(request('status') === 'scheduled', function ($query) {
                    $query->where('status', AppointmentStatus::WADIYAH);
                })
                ->when(request('status') === 'confirmed', function ($query) {
                    $query->where('status', AppointmentStatus::MUDHARABAH);
                })
                ->when(request('status') === 'cancelled', function ($query) {
                    $query->where('status', AppointmentStatus::VALAS);
                })
                ->count();

            return response()->json([
                'totalAppointmentsCount' => $totalAppointmentsCount,
            ]);
        }
    }

    public function getAppointmentsCount(request $request)
    {
        $wadiyahCount = Appointment::where('status', AppointmentStatus::WADIYAH)->count();
        $mudharabahCount = Appointment::where('status', AppointmentStatus::MUDHARABAH)->count();
        $valasCount = Appointment::where('status', AppointmentStatus::VALAS)->count();

        return response()->json([
            'wadiyahCount' => $wadiyahCount,
            'mudharabahCount' => $mudharabahCount,
            'valasCount' => $valasCount,
        ]);
    }
    public function getAllAppointments(Request $request)
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }
}
