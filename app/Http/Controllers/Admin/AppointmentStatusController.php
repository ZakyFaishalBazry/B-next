<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentStatusController extends Controller
{
    public function getStatusCount()
    {
        $statuses = AppointmentStatus::cases();

        $statusCounts = collect($statuses)->map(function ($status) {
            return [
                'name' => $status->name,
                'value' => $status->value,
                'count' => Appointment::where('status', $status->value)->count()
            ];
        });

        return response()->json($statusCounts);
    }
}
