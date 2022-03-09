<?php

use Dcat\Admin\Category\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('/category', Controllers\CategoryController::class);
