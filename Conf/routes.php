<?php

/**
 * Fichier de definition des routes
 * 
 */

$paramsAuthed = array('auth' => true);
$paramsAdmin = array('auth' => true, 'admin' => true);

// Controller front (routes for html pages)
//    Users
Route::add('/', 'front', 'index');
Route::add('/login', 'front', 'login');
Route::add('/logout', 'front', 'logout', $paramsAuthed);
//    Reservations
Route::add('/reservations', 'front', 'reservations', $paramsAuthed);
Route::add('/reservations/[id]', 'front', 'reservation', $paramsAuthed);


// Controller api
//    Users
Route::add('/api/login', 'api', 'Auth_login');
Route::add('/api/logout', 'api', 'auth_logout', $paramsAuthed);
Route::add('/api/user', 'api', 'user_get', $paramsAuthed);
//    Reservations
Route::add('/api/reservations', 'api', 'bookings_get_now', $paramsAuthed);




// Controller admin
Route::add('/admin', 'admin', 'index', $paramsAdmin);
//    Reset database
Route::add('/admin/reset', 'admin', 'reset');

// Test route with parameters
Route::add('/test/[id]/[nom]', 'front', 'test');


// unset unused variables
unset($paramsAuthed);
unset($paramsAdmin);