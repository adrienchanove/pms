<?php

/**
 * Controller par défaut
 * Front
 */

class FrontController
{

    /**
     * Page de login
     */
    public function login()
    {
        if (Auth::isLogged()) {
            header("location: /");
            exit;
        }
        view('user/login');
    }


    /**
     * Page logout
     */
    public function logout()
    {
        Auth::logout();
        header("location: /");
        exit;
    }

    /**
     * Page d'accueil
     */
    public function index()
    {
        if (Auth::isLogged()) {
            // include view
            view('index');
        } else {
            header("location: /login");
        }
    }

    /**
     * Page de test
     */
    public function test( $params ){
        // include view
        view('test', ['params' => $params]);
    }

}
