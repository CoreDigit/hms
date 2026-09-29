<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Models\Cruds\Ward;
use App\Models\Cruds\Bed;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index()
    {
        $wards = Ward::with(['beds' => function ($q) {
            $q->with('admission.patient');
        }])->get();

        $stats = [
            'total' => Bed::count(),
            'available' => Bed::where('status', 'available')->count(),
            'occupied' => Bed::where('status', 'occupied')->count(),
            'cleaning' => Bed::where('status', 'cleaning')->count(),
            'maintenance' => Bed::where('status', 'maintenance')->count(),
        ];

        return view('cruds.beds.index', compact('wards', 'stats'));
    }

    public function storeWard(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ward_type' => 'required|string',
            'daily_charge' => 'required|numeric|min:0',
        ]);

        Ward::create($request->only(['name', 'ward_type', 'floor_number', 'description', 'daily_charge']));

        return redirect()->back()->with('success', 'Ward created successfully!');
    }

    public function storeBed(Request $request)
    {
        $request->validate([
            'ward_id' => 'required|exists:wards,id',
            'bed_number' => 'required|string|max:100',
            'daily_charge' => 'required|numeric|min:0',
        ]);

        Bed::create([
            'ward_id' => $request->ward_id,
            'bed_number' => $request->bed_number,
            'bed_type' => $request->bed_type ?? 'standard',
            'status' => 'available',
            'daily_charge' => $request->daily_charge,
        ]);

        return redirect()->back()->with('success', 'Bed added successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $bed = Bed::findOrFail($id);
        $request->validate(['status' => 'required|in:available,occupied,cleaning,maintenance']);

        $bed->status = $request->status;
        $bed->save();

        return response()->json(['success' => true, 'message' => "Bed #{$bed->bed_number} status updated to {$request->status}"]);
    }
}
