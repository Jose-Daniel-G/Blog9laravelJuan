<?php

namespace App\Http\Controllers;

use App\Imports\ActividadesTransporteImport;
use App\Models\Python;
use Maatwebsite\Excel\Facades\Excel;
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
    {
        $request->validate(['csv_file' => 'required|mimes:csv,xlsx|max:2048']);

        $scriptPath = storage_path('app/scripts/verificar.py');
        $output = exec("python $scriptPath 2>&1", $outputArray);
        $output = implode("\n", $outputArray);


        Excel::import(new ActividadesTransporteImport, $request->file('csv_file'));

        return view('admin.multimedia.index', ['resultado' => nl2br($output)]);
    }
    // public function store(Request $request)
    // {
    //     $scriptPath = storage_path('app/scripts/verificar.py');

    //     // Ejecutar el script y capturar la salida
    //     $output = shell_exec("python3 $scriptPath 2>&1");

    //     // Manejo de errores
    //     if (!$output || stripos($output, 'error') !== false) {
    //         return redirect()->back()->with('error', 'El archivo no existe o hubo un error en la ejecución.');
    //     }

    //     return redirect()->back()->with('success', 'El archivo se verificó correctamente y se guardó en la base de datos.');
    // }


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
