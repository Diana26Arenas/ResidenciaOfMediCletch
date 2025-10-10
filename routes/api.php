<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return response()->json(['message' => 'La API está funcionando correctamente 🎉']);
});
