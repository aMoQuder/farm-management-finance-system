<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\MachineJob;
use App\Model\Crop;
use Illuminate\Http\Request;

class MachineJobController extends Controller
{
    public function index()
    {
        $machineJobs = MachineJob::all();
        return response()->json($machineJobs, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_id' => 'required|exists:crops,id',
            'machine_name' => 'required|string',
            'work_name' => 'required|string',
            'count_hour' => 'required|numeric',
            'driver_id' => 'required|exists:workers,id',
            'work_day' => 'required|date',
        ]);

        $machineJob = MachineJob::create($validated);
        return response()->json($machineJob, 201);
    }

    public function show($id)
    {
        $machineJob = MachineJob::findOrFail($id);
        return response()->json($machineJob, 200);
    }

    public function update(Request $request, $id)
    {
        $machineJob = MachineJob::findOrFail($id);

        $validated = $request->validate([
            'machine_name' => 'sometimes|string',
            'work_name' => 'sometimes|string',
            'count_hour' => 'sometimes|numeric',
            'driver_id' => 'sometimes|exists:workers,id',
            'work_day' => 'sometimes|date',
        ]);

        $machineJob->update($validated);
        return response()->json($machineJob, 200);
    }

    public function destroy($id)
    {
        $machineJob = MachineJob::findOrFail($id);
        $machineJob->delete();
        return response()->json(['message' => 'Machine Job deleted successfully'], 200);
    }
}
