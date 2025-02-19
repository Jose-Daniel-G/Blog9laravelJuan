    <?php

use App\Http\Controllers\ActividadesTransporteController;
use App\Http\Controllers\HomeController;
    use App\Http\Controllers\PostController;
    use App\Http\Controllers\VehiculoController;
    use Illuminate\Support\Facades\Route;


    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/blog', [PostController::class,'index'])->name('posts.index');

    Route::get('posts/{post}', [PostController::class,'show'])->name('posts.show');
    Route::get('categories/{category}', [PostController::class,'category'])->name('posts.category');
    Route::get('tag/{tag}',[PostController::class, 'tag'])->name('posts.tag');



    Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
    ->group(function () {Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');});


Route::get('/upload-csv', [ActividadesTransporteController::class, 'showForm'])->name('csv.form');
Route::post('/upload-csv', [ActividadesTransporteController::class, 'uploadCSV'])->name('csv.upload');

use App\Http\Controllers\FileUploadController;

Route::post('/upload-pdf', [FileUploadController::class, 'upload'])->name('upload.pdf');
Route::get('/upload-multiple-pdf', [FileUploadController::class, 'showUploadMultiple'])->name('upload.multiple.form');
Route::post('/upload-multiple-pdf', [FileUploadController::class, 'uploadMultiple'])->name('upload.multiple.pdf');

// RUTAS MULTIMEDIA ADMIN
use App\Http\Controllers\PythonController;

Route::get('/ejecutar-python', [PythonController::class, 'index'])
    ->name('admin.multimedia.index')
    ->middleware('auth');

Route::post('/ejecutar-python', [PythonController::class, 'store'])
    ->name('ejecutar-python');