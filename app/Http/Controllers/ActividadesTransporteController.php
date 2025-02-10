<?php

namespace App\Http\Controllers;

use App\Imports\ActividadesTransporteImport;
use App\Models\ActividadesTransporte;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ActividadesTransporteController extends Controller
{
    public function showForm()
    {
        return view('/admin/upload-csv');
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,xlsx|max:2048'
        ]);

        Excel::import(new ActividadesTransporteImport, $request->file('csv_file'));

        return back()->with('success', 'Archivo importado correctamente.');
    }
 
    public function index()
    {
        //
    }

 
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }

 
    public function show(ActividadesTransporte $cSVmovilidad)
    {
        //
    }

 
    public function edit(ActividadesTransporte $cSVmovilidad)
    {
        //
    }

 
    public function update(Request $request, ActividadesTransporte $cSVmovilidad)
    {
        //
    }

 
    public function destroy(ActividadesTransporte $cSVmovilidad)
    {
        //
    }
}
