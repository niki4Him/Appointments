<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $user = auth()->user();
        $user->appointments()->create($request->validated());

        return redirect()->route('appointments.index')
            ->with('success', 'Успешно запазихте час! Клиентът ще бъде уведомен чрез ' . $request->notification_method . '.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $otherAppointments = Appointment::where('egn', $appointment->egn)
            ->where('id', '!=', $appointment->id)
            ->where('appointment_date', '>', now())
            ->get();
        return view('appointments.show', compact('appointment', 'otherAppointments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        return view('appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'Часът беше успешно обновен.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        
        return redirect()->route('appointments.index')
            ->with('success', 'Часът беше успешно изтрит.');
    }
}
