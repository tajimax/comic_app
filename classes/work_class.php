<?php

class Work {
    public $title;
    public $author;
    public $save_path;
    public $save_filename;

    public function __construct($title, $author, $save_path, $save_filename) {
        $this -> title = $title;
        $this -> author = $author;
        $this -> save_path = $save_path;
        $this -> save_filename = $save_filename;
    }

}