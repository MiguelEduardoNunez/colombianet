<?php

use App\Http\Controllers\Administracion\ModuloController;
use App\Http\Controllers\Administracion\PerfilController;
use App\Http\Controllers\Administracion\PermisoController;
use App\Http\Controllers\Administracion\UsuarioController;
use App\Http\Controllers\ArchivoElementoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ElementoNovedadController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaSubcategoriaController;
use App\Http\Controllers\DetalleElementoController;
use App\Http\Controllers\ElementoEntradaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProyectoElementoController;
use App\Http\Controllers\ProyectoEntradaElementoController;
use App\Http\Controllers\ProyectoEntregaElementoController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\TipoNovedadController;
use App\Models\ArchivoEmpleado;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta Inicio Sesion
Route::get('/', function () {
    return view('auth.login');
});

// Ruta Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas Perfil Usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas Administracion //
// Rutas Modulos
Route::resource('/modulos', ModuloController::class)->middleware('auth');

// Rutas Perfiles
Route::resource('/perfiles', PerfilController::class)->middleware('auth');

// Rutas Permisos
Route::get('/permisos/{perfil}', [PermisoController::class, 'edit'])->name('permisos.edit')->middleware('auth');
Route::put('/permisos/{perfil}', [PermisoController::class, 'update'])->name('permisos.update')->middleware('auth');

// Rutas Usuarios
Route::resource('/usuarios', UsuarioController::class)->middleware('auth');

// Rutas Inventarios //

// Rutas Stands
Route::resource('/stands', StandController::class)->middleware('auth');

// Rutas Empleados
Route::resource('/empleados', EmpleadoController::class)->middleware('auth');

// Rutas Categorias
Route::resource('/categorias', CategoriaController::class)->middleware('auth');

// Rutass Categorias Subcategorias
Route::resource('/categorias.subcategorias', CategoriaSubcategoriaController::class)->middleware('auth');
Route::get('/categorias/{id_categoria}/subcategorias-import', [CategoriaSubcategoriaController::class, 'createImport'])->name('categorias.subcategorias.createImport')->middleware('auth');
Route::post('/categorias/{id_categoria}/subcategorias-import', [CategoriaSubcategoriaController::class, 'storeImport'])->name('categorias.subcategorias.storeImport')->middleware('auth');

// Rutas Items
Route::get('/items-importar/create', [ItemController::class, 'createImport'])->name('items.createImport')->middleware('auth');
Route::post('/items-importar', [ItemController::class, 'storeImport'])->name('items.storeImport')->middleware('auth');
Route::resource('/items', ItemController::class)->middleware('auth');

// Rutas Detalle Elementos
Route::resource('/tipo_novedades', TipoNovedadController::class)->middleware('auth');

// Rutas para archivos de empleados, anidadas bajo empleados
Route::resource('empleados.archivo_elementos', ArchivoElementoController::class)->middleware('auth');


// Rutas Proyectos
Route::resource('/proyectos', ProyectoController::class)->middleware('auth');

// Rutas Elementos
Route::get('proyectos/{id_proyecto}/elementos/pdf-elementos', [ProyectoElementoController::class, 'pdfElementos'])->name('proyectos.elementos.pdf');
Route::get('/migrar-elementos/{id_proyecto}', [ProyectoElementoController::class, 'migrarElementosCreate'])->name('proyectos.migrar.elementos');
Route::post('/migrar-elementos/{id_proyecto}', [ProyectoElementoController::class, 'migrarElementosStore'])->name('proyectos.migrar.elementos.store');
Route::resource('/proyectos.elementos', ProyectoElementoController::class)->middleware('auth');

//Ruta informes
Route::get('/informes', [InformeController::class, 'index'])->name('informes.index')->middleware('auth');

// Rutas Novedades
Route::resource('/elementos.novedades', ElementoNovedadController::class)->middleware('auth');

// Rutas para entradas de elementos
Route::middleware('auth')->group(function () {
    Route::get('proyectos/{id_proyecto}/entrada-elementos/create', [ElementoEntradaController::class, 'create'])->name('entrada_elementos.create');
    Route::post('proyectos/{id_proyecto}/entrada-elementos', [ElementoEntradaController::class, 'store'])->name('entrada_elementos.store');
    Route::get('proyectos/{id_proyecto}/entrada-elementos', [ElementoEntradaController::class, 'index'])->name('entrada_elementos.index');
    Route::get('proyectos/{id_proyecto}/entrada-elementos/{id_entrada_elementos}', [ElementoEntradaController::class, 'show'])->name('entrada_elementos.show');
});

// Rutas Entregas de Elementos
Route::get('/proyectos/{proyecto}/entregas-elementos/{entrega_elemento}/reporte', [ProyectoEntregaElementoController::class, 'reporte'])->name('proyectos.entregas-elementos.reporte');
Route::get('/proyectos/{proyecto}/entregas-elementos/{entrega_elemento}/reporte_devolucion', [ProyectoEntregaElementoController::class, 'reporteDevolucion'])->name('proyectos.entregas-elementos.reporte_devolucion');
Route::resource('/proyectos.entregas-elementos', ProyectoEntregaElementoController::class)->middleware('auth');

//Ruta Detalle Elementos
Route::post('/proyectos/{id_proyecto}/elementos-importar', [ProyectoElementoController::class, 'storeImport'])->name('elementos.storeImport')->middleware('auth');
Route::get('/proyectos/{id_proyecto}/elementos-importar', [ProyectoElementoController::class, 'createImport'])->name('elementos.createImport')->middleware('auth');

require __DIR__.'/auth.php';
