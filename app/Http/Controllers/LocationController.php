<?php
// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Location::select('*'))
                ->addColumn('action', 'locations.action')
                ->addIndexColumn()
                ->make(true);
        }
        return view('locations.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:locations,code,' . $request->code,
            'name' => 'required|string|max:100',
        ]);

        $location = Location::updateOrCreate(
            ['code' => $request->code],
            ['name' => $request->name]
        );

        return response()->json($location);
    }

    public function edit($code)
    {
        $location = Location::find($code);
        if ($location) {
            return response()->json($location);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        }

    public function destroy($code)
    {
        $location = Location::where('code', $code)->first();
        if ($location) {
            $location->delete();
            return response()->json(['success' => true, 'message' => 'Location deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Location not found'], 404);
    }
}
