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


// Controller admin
Route::add('/admin', 'admin', 'index', $paramsAdmin);

// Test route with parameters
Route::add('test/[id]/[nom]', 'index', 'test');


// unset unused variables
unset($paramsAuthed);
unset($paramsAdmin);