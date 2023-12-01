<?php

class CourseReview {
    private $id, $user_id, $course_id, $review, $rating;

    function __construct($id = null, $user_id = null, $course_id = null, $review = "", $rating = null) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->review = $review;
        $this->rating = $rating;
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

    public function getReview() {
        return $this->review;
    }

    public function getRating() {
        return $this->rating;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setCourseId($course_id) {
        $this->course_id = $course_id;
    }

    public function setReview($review) {
        $this->review = $review;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }
}


?>