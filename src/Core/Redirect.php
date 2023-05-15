<?php

class Redirect {
    public static function to($location = null) {

        if(!stristr($location,'?')) {
          if (!file_exists($location)) {
                $location = '../404.php';
          }
        } else {
            if (!file_exists(stristr($location,'?',true))) {
                $location = '../404.php';
            }
        }
        header('Location: ' . $location);
    }
}