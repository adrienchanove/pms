<?php

/**
 * Fichier de definition des routes
 * 
 */

$paramsAuthed = array('auth' => true);
$paramsAdmin = array('auth' => true, 'admin' => true);

// Controller index (page commune)
Route::add('/', 'index', 'index');

// Controller user
Route::add('/login', 'user', 'login');
Route::add('/logout', 'user', 'logout', $paramsAuthed);

// Controller api
Route::add('/api/login', 'api', 'Auth_login');
Route::add('/api/logout', 'api', 'auth_logout', $paramsAuthed);
Route::add('/api/user', 'api', 'user_get', $paramsAuthed);


// Controller admin
Route::add('/admin', 'admin', 'index', $paramsAdmin);

// Test route with parameters
Route::add('test/[id]/[nom]', 'index', 'test');


// unset unused variables
unset($paramsAuthed);
unset($paramsAdmin);