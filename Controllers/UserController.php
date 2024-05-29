<?php


/**
 * User Controller
 * 
 */
class UserController {
    
        /**
        * Page d'accueil
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
         * Page profile
         */
        public function profile()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // open view
            view('user/profile');
        }

        /**
         * Page edit
         */
        public function edit()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // Check post
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $user = User::getByUsername($_POST['username']);
                $user->password = $_POST['password'];
                $user->save();
                header("location: /profile");
                exit;
            }
            // open view
            view('user/edit');
        }

        /**
         * Page faq
         */
        public function faq()
        {
            // open view
            view('faq');
        }



    
        /**
         * Page admin
         */
        public function admin()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // open view
            view('admin/admin');
        }

        /**
         * Page admin_bdd
         */
        public function admin_bdd()
        {
            // Check auth
            Auth::check(['admin' => 'admin']);
            // Check get
            if (isset($_GET['reset'])) {
                $bdd = new Bdd();
                $bdd->resetDatabase();
                header("location: /admin/bdd");
                exit;
            }
            // open view
            view('admin/db');
        }


}
