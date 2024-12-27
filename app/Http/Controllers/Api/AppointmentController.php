<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::query()
            ->where('user_id', auth()->id())
            ->when($request->filled('egn'), function ($query) use ($request) {
                $query->where('egn', $request->egn);
            })
            ->when($request->filled('from_date') && $request->filled('to_date'), function ($query) use ($request) {
                $query->whereBetween('appointment_date', [$request->from_date, $request->to_date]);
            })
            ->paginate(10);
        return AppointmentResource::collection($appointments);
    }

    public function store(AppointmentRequest $request)
    {
        $appointment = Appointment::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return new AppointmentResource($appointment);
    }

    public function show(Appointment $appointment)
    {
        return new AppointmentResource($appointment);
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());
        return new AppointmentResource($appointment);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully.']);
    }
}
