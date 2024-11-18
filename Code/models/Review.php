<?php

  class Review {
    public $id;
    public $rating;
    public $review;
    public $games_id;
    public $users_id;
  }

  interface ReviewDAOInterface {

    public function buildReview($data);
    public function create(Review $review);
    public function getGamesReview($id);
    public function hasAlreadyReviewed($id, $userId);
    public function getRatings($id);

  }
?>