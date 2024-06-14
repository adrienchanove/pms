<?php

class AdminController
{
    /**
     * AdminController constructor
     */
    public function __construct()
    {
    }

    /**
     * Index
     * 
     * @return void
     */
    public function index()
    {
        $this->render('admin/index');
    }

    /**
     * Reset database
     * 
     * @return void
     */
    public function reset()
    {
        $bdd = new Bdd();
        $bdd->resetDatabase();
        echo json_encode(['error' => false, 'errorMessages' => ['Database reset']]);
    }
}