<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPdfRequest;
use App\Models\ActividadesTransporte;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function showUploadMultiple (){
        return view('admin.upload-multiple-pdf');

    }
    public function upload(UploadPdfRequest $request)
    {
        $file = $request->file('pdf');
        $filename = $file->getClientOriginalName();

        // Guardar en storage/app/pdfs
        $path = $file->storeAs('pdfs', $filename);

        return response()->json(['message' => 'Archivo subido con éxito', 'path' => $path]);
    }
    public function uploadMultiple(Request $request)
    {
        // Validación de archivos PDF
        $request->validate([
            'pdfs' => 'required|array',
            'pdfs.*' => 'mimes:pdf|max:10420', // Cada archivo debe ser PDF y no superar 5MB
        ]);

        $no_encontrados = [];
        $subidos = 0;

        // Recorrer cada archivo subido
        foreach ($request->file('pdfs') as $pdf) {
            $nombreArchivo = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME); // Extraer nombre sin extensión

            // Verificar si el nombre del archivo coincide con un `nom_con` en la BD
            $existe = ActividadesTransporte::where('nom_con', $nombreArchivo)->exists();

            if ($existe) {
                // Guardar el archivo en storage/app/pdfs
                $pdf->storeAs('pdfs', $pdf->getClientOriginalName());
                $subidos++;
            } else {
                // Agregar a la lista de no encontrados
                $no_encontrados[] = $nombreArchivo;
            }
        }

        // Mensaje de respuesta
        if ($subidos > 0 && empty($no_encontrados)) {
            return back()->with('success', "$subidos archivo(s) subido(s) correctamente.");
        } elseif ($subidos > 0) {
            return back()->with('success', "$subidos archivo(s) subido(s). Algunos archivos no coincidieron con la base de datos: " . implode(', ', $no_encontrados));
        } else {
            return back()->withErrors(['msg' => "Ningún archivo coincidió con la base de datos."]);
        }
    }
}
