<?php

use App\Http\Controllers\GreetingsController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/operacion/{operacion}/{num1}/{num2}', function ($operacion, $num1, $num2) {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return view('error', ['message' => 'Parámetros no válidos']);
    }

    switch ($operacion) {
        case 'suma':
            $result = $num1 + $num2;
            return view('operaciones', ['operation' => 'Suma', 'result' => $result]);
        case 'resta':
            $result = $num1 - $num2;
            return view('operaciones', ['operation' => 'Resta', 'result' => $result]);
        case 'division':
            $result = $num1 / $num2;
            return view('operaciones', ['operation' => 'Division', 'result' => $result]);
        case 'multiplicacion':
            $result = $num1 * $num2;
            return view('operaciones', ['operation' => 'Multiplicacion', 'result' => $result]);
        default:
            return view('error', ['message' => 'Operación no válida']);
    }
});

Route::get('/saludo/{name}/{lastname}', function ($name, $lastname) {
    if (is_numeric($name) || is_numeric($lastname)) {
        return view('error', ['message' => 'Parametros no validos']);
    }
    return view('greeting', ['name' => ucwords(strtolower($name)), 'lastname' => ucwords(strtolower($lastname))]);
})->name('greeting');

Route::controller(GreetingsController::class)->group(function () {
    Route::get('/saludo-controlador/{name}/{lastname}', 'index');
})->name('greeting-controller');
