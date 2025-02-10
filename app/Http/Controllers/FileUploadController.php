<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadPdfRequest;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(UploadPdfRequest $request)
    {
        $file = $request->file('pdf');
        $filename = $file->getClientOriginalName();

        // Guardar en storage/app/pdfs
        $path = $file->storeAs('pdfs', $filename);

        return response()->json(['message' => 'Archivo subido con éxito', 'path' => $path]);
    }
}
