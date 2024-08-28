<?php
// app/Http/Controllers/EmployeeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Kembalikan view yang menampilkan daftar karyawan
        return view('employees.index');
    }
}

// app/Http/Controllers/LocationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Kembalikan view yang menampilkan daftar lokasi
        return view('locations.index');
    }
}
