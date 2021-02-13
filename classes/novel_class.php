<?php
require_once('work_class.php');

class Novel extends Work {
    public $genre;

    public function __construct($title, $author, $genre, $save_path, $save_filename) {
        parent::__construct($title, $author, $save_path, $save_filename);
        $this -> genre = $genre;
    }

}