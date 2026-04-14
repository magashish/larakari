<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaintenanceLog;
use Illuminate\Support\Facades\Auth;

class MaintenanceLogController extends Controller
{
    // ── Issue Items ────────────────────────────────────────────────────────────

    public function indexIssue($unit_id = 0)
    {
        $logs = MaintenanceLog::where('type', 'issue')
            ->when($unit_id, fn($q) => $q->where('unit_id', $unit_id))
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('issue_items', compact('logs', 'unit_id'));
    }

    public function createIssue()
    {
        return view('add_issue_item');
    }

    public function storeIssue(Request $request)
    {
        $request->validate([
            'unit_id'     => 'required|integer|exists:units,id',
            'date'        => 'required|date',
            'description' => 'required|string',
            'amount'      => 'required|numeric|min:0',
        ]);

        // Use the type from the hidden form field; fall back to 'issue'
        $type = in_array($request->input('type'), ['issue', 'maintenance'])
            ? $request->input('type')
            : 'issue';

        MaintenanceLog::create([
            'user_id'     => Auth::id(),
            'type'        => $type,
            'unit_id'     => $request->unit_id,
            'date'        => $request->date,
            'description' => $request->description,
            'amount'      => $request->amount,
        ]);

        return redirect()->route('issue-items.index')
            ->with('status', 'Issue item added successfully.');
    }

    // ── Maintenance Log ────────────────────────────────────────────────────────

    public function indexMaintenance($unit_id = 0)
    {
        $logs = MaintenanceLog::where('type', 'maintenance')
            ->when($unit_id, fn($q) => $q->where('unit_id', $unit_id))
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('maintenance_logs', compact('logs', 'unit_id'));
    }

    public function createMaintenance()
    {
        return view('add_maintenance_log');
    }

    public function storeMaintenance(Request $request)
    {
        $request->validate([
            'unit_id'     => 'required|integer|exists:units,id',
            'date'        => 'required|date',
            'description' => 'required|string',
            'amount'      => 'required|numeric|min:0',
        ]);

        // Use the type from the hidden form field; fall back to 'maintenance'
        $type = in_array($request->input('type'), ['issue', 'maintenance'])
            ? $request->input('type')
            : 'maintenance';

        MaintenanceLog::create([
            'user_id'     => Auth::id(),
            'type'        => $type,
            'unit_id'     => $request->unit_id,
            'date'        => $request->date,
            'description' => $request->description,
            'amount'      => $request->amount,
        ]);

        return redirect()->route('maintenance-log.index')
            ->with('status', 'Maintenance log entry added successfully.');
    }

    // ── Unified save (type comes from URL path, not form body) ─────────────────

    public function save(Request $request, string $type)
    {
        $request->validate([
            'unit_id'     => 'required|integer|exists:units,id',
            'date'        => 'required|date',
            'description' => 'required|string',
            'amount'      => 'required|numeric|min:0',
        ]);

        MaintenanceLog::create([
            'user_id'     => Auth::id(),
            'type'        => $type,
            'unit_id'     => $request->unit_id,
            'date'        => $request->date,
            'description' => $request->description,
            'amount'      => $request->amount,
        ]);

        if ($type === 'issue') {
            return redirect()->route('issue-items.index')
                ->with('status', 'Issue item added successfully.');
        }

        return redirect()->route('maintenance-log.index')
            ->with('status', 'Maintenance log entry added successfully.');
    }

    // ── Shared ─────────────────────────────────────────────────────────────────

    public function destroy($id)
    {
        $log = MaintenanceLog::findOrFail($id);
        $log->delete();

        return redirect()->back()
            ->with('status', 'Entry deleted successfully.');
    }
}
