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

    /**
     * page de liste de reservation
     */
    public function reservations( $params ){
        // include view
        view('reservation/list', ['params' => $params]);
    }

    /**
     * page de modification de reservation
     */
    public function reservation( $params ){
        // include view
        view('reservation/edit', ['params' => $params]);
    }



}
