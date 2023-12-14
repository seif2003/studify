<?php

class Course {
    private $id, $title, $description, $content, $admin_id,$file_url;

    function __construct($id = null, $title = "", $description = "", $content = "", $admin_id = null,$file_url="") {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->admin_id = $admin_id;
        $this->file_url = $file_url;
    }

    public function getFile_url(){
        return $this->file_url;
    }
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }

    public function getAdminId() {
        return $this->admin_id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setAdminId($admin_id) {
        $this->admin_id = $admin_id;
    }
}

?>