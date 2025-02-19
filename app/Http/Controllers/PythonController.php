<?php

namespace App\Http\Controllers;

use App\Models\Python;
use Illuminate\Http\Request;

class PythonController extends Controller
{
    public function index()
    {
        return view('admin.multimedia.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   $scriptPath = storage_path('app/scripts/verificar.py');
        $output = exec("python $scriptPath 2>&1", $outputArray);
        $output = implode("\n", $outputArray);
        // 
        // $output = shell_exec("python3 $scriptPath 2>&1");

        return view('admin.multimedia.index', ['resultado' => nl2br($output)]);
    }

    public function show(Python $python)
    {
        //
    }

    public function edit(Python $python)
    {
        //
    }

    public function update(Request $request, Python $python)
    {
        //
    }

    public function destroy(Python $python)
    {
        //
    }
}
