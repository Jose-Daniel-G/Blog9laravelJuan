    <?php

    use App\Http\Controllers\ActividadesTransporteController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\PostController;
    use Illuminate\Support\Facades\Route;


    Route::get('/prueba', function () {
        return view('index-prueba');
    });
    Route::get('/', function () {
        return view('welcome');
    });
    // Route::get('/', function () {return view('auth.login');});

    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');

    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('categories/{category}', [PostController::class, 'category'])->name('posts.category');
    Route::get('tag/{tag}', [PostController::class, 'tag'])->name('posts.tag');



    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
        ->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
        });

    // RUTAS MULTIMEDIA ADMIN
    use App\Http\Controllers\PythonController;

    Route::get('/ejecutar-python', [ActividadesTransporteController::class, 'index'])
        ->name('admin.multimedia.index')
        ->middleware('auth');

    Route::post('/ejecutar-python', [ActividadesTransporteController::class, 'store'])
        ->name('ejecutar-python');

    Route::get('/upload-csv', [ActividadesTransporteController::class, 'showForm'])->name('csv.form');
    Route::post('/upload-csv', [ActividadesTransporteController::class, 'uploadCSV'])->name('csv.upload');
