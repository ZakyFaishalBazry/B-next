<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Enums\AppointmentStatus;
use App\Models\Appoinment;
use App\Models\Client;

// use App\Models\Appoinment;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::query()
            ->with('client:id,first_name,last_name,email')
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', AppointmentStatus::from((int)$request->status));
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->whereHas('client', function ($q) use ($request) {
                    $q->where('first_name', 'like', '%' . $request->search . '%')
                        ->orWhere('last_name', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(5)
            ->through(fn ($appointment) => [
                'id' => $appointment->id,
                'status' => $appointment->status->name, // Ensure the status value is sent as an integer
                'client' => $appointment->client,
            ]);

        return response()->json($appointments);
    }

    public function statuses()
    {
        $statuses = AppointmentStatus::cases(); // Assuming PHP 8.1+ enums
        return response()->json(array_map(fn ($status) => ['name' => $status->name, 'value' => $status->value], $statuses));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => ['required', 'integer', 'in:' . implode(',', array_column(AppointmentStatus::cases(), 'value'))],
        ]);

        $client = Client::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
        ]);

        $appointment = Appointment::create([
            'client_id' => $client->id,
            'status' => AppointmentStatus::from($validated['status']),
        ]);

        return response()->json(['message' => 'Appointment created successfully', 'appointment' => $appointment], 201);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => ['required', 'integer', 'in:' . implode(',', array_column(AppointmentStatus::cases(), 'value'))],
        ]);

        $client = $appointment->client;
        $client->first_name = $validated['first_name'];
        $client->last_name = $validated['last_name'];
        $client->email = $validated['email'];
        $client->save();

        $appointment->status = AppointmentStatus::from($validated['status']);
        $appointment->save();

        return response()->json(['message' => 'Appointment updated successfully']);
    }

    public function destroy(Appoinment $appoinment)
    {
        $appoinment->delete();

        return response()->json(['success' => true], 200);
    }
}
