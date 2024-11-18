<?php

  require_once("models/Review.php");
  require_once("models/Message.php");

  require_once("dao/UserDAO.php");

  class ReviewDAO implements ReviewDAOInterface {

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    public function buildReview($data) {
      $review = new Review();

      $review->id = $data["id"];
      $review->rating = $data["rating"];
      $review->review = $data["review"];
      $review->games_id = $data["games_id"];
      $review->users_id = $data["users_id"];

      return $review;
    }

    public function create(Review $review) {
      $stmt = $this->conn->prepare("INSERT INTO reviews (
        rating, review, games_id, users_id
      ) VALUES (
        :rating, :review, :games_id, :users_id
      )");

      $stmt->bindParam(":rating", $review->rating);
      $stmt->bindParam(":review", $review->review);
      $stmt->bindParam(":games_id", $review->games_id);
      $stmt->bindParam(":users_id", $review->users_id);

      $stmt->execute();

      // Mensagem de sucesso por adicionar review
      $this->message->setMessage("Crítica adicionada com sucesso!", "success", "index.php");
    }

    public function getGamesReview($id) {
      $reviews = [];

      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE games_id = :games_id");

      $stmt->bindParam(":games_id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {
        $reviewsData = $stmt->fetchAll();

        $userDao = new UserDao($this->conn, $this->url);

        foreach($reviewsData as $review) {
          $reviewObject = $this->buildReview($review);
          // Chamar dados do usuário
          $user = $userDao->findById($reviewObject->users_id);
          $reviewObject->user = $user;
          $reviews[] = $reviewObject;
        }
      }

      return $reviews;
    }

    public function hasAlreadyReviewed($games_id, $users_id) {
      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE games_id = :games_id AND users_id = :users_id");

      $stmt->bindParam(":games_id", $games_id);
      $stmt->bindParam(":users_id", $users_id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    public function getRatings($games_id) {
      $stmt = $this->conn->prepare("SELECT AVG(rating) as rating FROM reviews WHERE games_id = :games_id");

      $stmt->bindParam(":games_id", $games_id);

      $stmt->execute();

      $rating = $stmt->fetch(PDO::FETCH_ASSOC);

      return $rating["rating"];
    }
  }
?>