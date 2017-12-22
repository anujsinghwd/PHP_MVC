<?php
/*
 * Base Controller
 * Load the models and view
 */

 class Controller {
     //Load Model
     public function model($model) {
         // require model file
         require_once "../app/models/".$model.'.php';

         //Intantiate model
         return new $model();
     }

     // load View
     public function view($view, $data = []) {
        // check for the view file
        if(file_exists('../app/views/'.$view.'.php')) {
            require_once '../app/views/'.$view.'.php';
        } else {
            // View Does not exists
            die('View Does Not exists');
        }
     }
 }