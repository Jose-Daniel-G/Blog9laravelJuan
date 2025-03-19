<?php

namespace App\Http\Controllers;

use App\Imports\ActividadesTransporteImport;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActividadesTransporteController extends Controller
{
    public function showForm()
    {
        return view('/admin/upload-csv');
    }
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
        $request->validate([
            'csv_file' => 'required|mimes:csv,xlsx|max:2048',
            'pdf_files.*' => 'required|mimes:pdf|max:2048' // Validar cada archivo PDF en el array
        ]);

        // Obtener el usuario autenticado
        $usuario = Auth::user();
        
        // Extraer la parte antes del @ del email
        $username = explode('@', $usuario->email)[0];
        $folder = "secretaria_de_movilidad";

        // Verificar PDFs en el CSV
        $response = $this->verificarPdfsEnCsv($username, $folder);

        if (!$response['success']) {
               return redirect()->back()->with('error', $response['message']);
        }

        // Si todo está bien, importar el CSV
        Excel::import(new ActividadesTransporteImport, $request->file('csv_file'));

        return redirect()->route('admin.multimedia.index')->with('success', 'Importación exitosa.');
    }

    // function verificarPdfsEnCsv($baseDir, $columnaNombrefde, $destino)
    function verificarPdfsEnCsv($username, $folder)
    {
        // Configuración de rutas
        $baseDir = storage_path('app/public'); // Nueva ruta correcta 
        $rutaCarpeta = $baseDir . '/users/'.$username; // Ruta Origen
        $destino = $baseDir."/pdfs/" . $folder; // Ruta Destino
        $columnaNombre = 'nom_con';
        // dd($destino);

        try {
            // Obtener archivos de la carpeta
            $archivos = scandir($rutaCarpeta);
            $archivosCsv = array_filter($archivos, fn($archivo) => pathinfo($archivo, PATHINFO_EXTENSION) === 'csv');
            $archivosPdf = array_map(
                fn($pdf) => strtolower(trim($pdf)),
                array_filter($archivos, fn($archivo) => pathinfo($archivo, PATHINFO_EXTENSION) === 'pdf')
            );

            if (empty($archivosCsv)) {
                return ["success" => false, "message" => "Error: No se encontró ningún archivo CSV en la carpeta."];
            }

            if (count($archivosCsv) > 1) {
                return ["success" => false, "message" => "Error: Solo debe haber un archivo CSV en la carpeta."];
            }

            if (empty($archivosPdf)) {
                return ["success" => false, "message" => "Error: No hay suficientes archivos PDF."];
            }

            // Obtener el archivo CSV
            $archivoCsv = $rutaCarpeta . '/' . reset($archivosCsv);
            $csv = array_map('str_getcsv', file($archivoCsv));

            // Obtener encabezados del CSV
            $encabezados = array_map('trim', $csv[0]);
            $datos = array_slice($csv, 1);

            if (!in_array($columnaNombre, $encabezados)) {
                return ["success" => false, "message" => "Error: El archivo CSV no contiene la columna '$columnaNombre'."];
            }

            // Obtener nombres válidos desde el CSV
            $indiceColumna = array_search($columnaNombre, $encabezados);
            $nombresValidos = array_map(fn($fila) => strtolower(trim($fila[$indiceColumna])), $datos);

            // Verificar PDFs que no están en el CSV
            $pdfsFaltantes = array_filter($nombresValidos, fn($nombre) => !in_array("$nombre.pdf", $archivosPdf));
            $pdfNoEncontrados = array_filter($archivosPdf, fn($pdf) => !in_array(str_replace('.pdf', '', $pdf), $nombresValidos));

            if (!empty($pdfNoEncontrados)) {
                return ["success" => false, "message" => "Error: Los siguientes PDFs no están en el CSV: " . implode(", ", $pdfNoEncontrados)];
            }

            if (!empty($pdfsFaltantes)) {
                return ["success" => false, "message" => "Error: Faltan los siguientes PDFs: " . implode(", ", $pdfsFaltantes)];
            }

            // Mover archivos PDF a la carpeta de destino
            if (!is_dir($destino)) {
                mkdir($destino, 0777, true);
            }

            foreach ($archivosPdf as $pdf) {
                rename("$rutaCarpeta/$pdf", "$destino/$pdf");
            }

            return ["success" => true, "message" => "Éxito: Todos los archivos PDF fueron movidos correctamente."];
        } catch (Exception $e) {
            return ["success" => false, "message" => "Error inesperado: " . $e->getMessage()];
        }
    }

    // public function store(Request $request)
    // {
    //     $request->validate(['csv_file' => 'required|mimes:csv,xlsx|max:2048']);

    //     // Ruta del script Python
    //     $scriptPath = storage_path('app/scripts/verificar.py');

    //     // Ejecutar el script Python y capturar la salida JSON
    //     $output = shell_exec("python $scriptPath 2>&1");

    //     // Decodificar la respuesta JSON de Python
    //     $response = json_decode($output, true);

    //     // Si la decodificación falla, forzar un formato de error
    //     if (!is_array($response)) {
    //         // Extraer solo el mensaje de error (elimina la ruta y detalles técnicos)
    //         preg_match('/"(Error:.*?)"/', $output, $matches);
    //         $mensajeError = $matches[1] ?? "Error desconocido al ejecutar el script.";

    //         $response = [
    //             'success' => false,
    //             'message' => $mensajeError,
    //         ];
    //     }

    //     // Retornar la vista con la respuesta decodificada
    //     return view('admin.multimedia.index', ['resultado' => $response]);
    // }


    // public function store(Request $request)
    // {
    //     $request->validate(['csv_file' => 'required|mimes:csv,xlsx|max:2048']);

    //     // Ejecutar el script Python y capturar la salida JSON
    //     $scriptPath = storage_path('app/scripts/verificar.py');
    //     $output = shell_exec("python $scriptPath 2>&1");

    //     // Decodificar la respuesta JSON de Python
    //     $response = json_decode($output, true);

    //     // Si no se puede decodificar o el script falla
    //     if (!$response || !isset($response['success'])) {
    //         return response()->json(['success' => false, 'message' => 'Error: Respuesta inválida del script.'], 400);
    //     }

    //     // Validar si el script retornó un error
    //     if (!$response['success']) {
    //         return response()->json(['success' => false, 'message' => $response['message']], 400);
    //     }

    //     // Si el script fue exitoso, importar el CSV
    //     Excel::import(new ActividadesTransporteImport, $request->file('csv_file'));

    //     return response()->json(['success' => true, 'message' => 'Archivo importado correctamente.']);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate(['csv_file' => 'required|mimes:csv,xlsx|max:2048']);

    //     $scriptPath = storage_path('app/scripts/verificar.py');
    //     $output = exec("python $scriptPath 2>&1", $outputArray);
    //     $output = implode("\n", $outputArray);
    //     $resultado = nl2br($output);

    //     Excel::import(new ActividadesTransporteImport, $request->file('csv_file'));
    //     return redirect()->back()->with('success', 'Archivo importado correctamente.');


    //     return view('admin.multimedia.index', $resultado);
    // }


    public function show()
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
