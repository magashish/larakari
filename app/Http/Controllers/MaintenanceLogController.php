<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use Illuminate\Support\Facades\Auth;

class MaintenanceLogController extends Controller
{
    public function index($unit_id = 0)
    {
        if ($unit_id) {
            $logs = MaintenanceLog::where('unit_id', $unit_id)
                ->orderBy('date', 'desc')
                ->paginate(20);
        } else {
            $logs = MaintenanceLog::orderBy('date', 'desc')
                ->paginate(20);
        }

        return view('maintenance_logs', compact('logs', 'unit_id'));
    }

    public function create()
    {
        return view('add_maintenance_log');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id'     => 'required|integer|exists:units,id',
            'date'        => 'required|date',
            'description' => 'required|string',
            'amount'      => 'required|numeric|min:0',
        ]);

        MaintenanceLog::create([
            'user_id'     => Auth::id(),
            'unit_id'     => $request->unit_id,
            'date'        => $request->date,
            'description' => $request->description,
            'amount'      => $request->amount,
        ]);

        return redirect()->route('maintenance-log.index')
            ->with('status', 'Maintenance log entry added successfully.');
    }

    public function destroy($id)
    {
        $log = MaintenanceLog::findOrFail($id);
        $log->delete();

        return redirect()->back()
            ->with('status', 'Maintenance log entry deleted successfully.');
    }
}
