<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Employee::select('*'))
                ->addColumn('action', 'employees.action')
                ->addIndexColumn()
                ->make(true);
        }
        return view('employees.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'location_code' => 'required|string|max:50',
            'birth_date' => 'required|date',
        ]);

        $employee = Employee::updateOrCreate(
            ['id' => $request->employee_id],
            [
                'name' => $request->name,
                'location_code' => $request->location_code,
                'birth_date' => $request->birth_date
            ]
        );

        return response()->json($employee);
    }

    public function edit($id)
    {
    $employee = Employee::find($id);
    if ($employee) {
        return response()->json($employee);
    } else {
        return response()->json(['error' => 'Employee not found'], 404);
    }
    }


    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json('Employee deleted successfully');
    }
}
