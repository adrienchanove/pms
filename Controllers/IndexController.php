<?php
/**
 * Controller par défaut
 * Index
 */

class IndexController
{
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
     * Page de contact
     */
    public function contact()
    {
        // include view
        view('contact');
    }

    /**
     * Page à propos
     */
    public function about()
    {
        // include view
        view('about');
    }

    /**
     * Page de test
     */
    public function test( $params ){
        // include view
        view('test', ['params' => $params]);


    }
}