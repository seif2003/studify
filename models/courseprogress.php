<?php

class CourseProgress {
    private $id, $user_id, $course_id, $status;

    function __construct($id = null, $user_id = null, $course_id = null, $status = "") {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getCourseId() {
        return $this->course_id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setCourseId($course_id) {
        $this->course_id = $course_id;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}



?>