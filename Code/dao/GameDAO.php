<?php

require_once("models/Message.php");
require_once("dao/ReviewDAO.php");
require_once("models/Game.php");

class GameDAO implements GameDAOInterface {

  private $conn;
  private $url;
  private $message;

  public function __construct(PDO $conn, $url) {
    $this->conn = $conn;
    $this->url = $url;
    $this->message = new Message($url);
  }

  public function buildGame($data) {
    $game = new Game();
    $game->id = $data["id"];
    $game->title = $data["title"];
    $game->description = $data["description"];
    $game->image = $data["image"];
    $game->trailer = $data["trailer"];
    $game->category = $data["category"];
    $game->length = $data["length"];
    $game->users_id = $data["users_id"];
    $reviewDao = new ReviewDAO($this->conn, $this->url);
    $game->rating = $reviewDao->getRatings($game->id);
    return $game;
  }

  public function create(Game $game) {
    $stmt = $this->conn->prepare("INSERT INTO games (
      title, description, image, trailer, category, length, users_id
    ) VALUES (
      :title, :description, :image, :trailer, :category, :length, :users_id
    )");
    $stmt->bindParam(":title", $game->title);
    $stmt->bindParam(":description", $game->description);
    $stmt->bindParam(":image", $game->image);
    $stmt->bindParam(":trailer", $game->trailer);
    $stmt->bindParam(":category", $game->category);
    $stmt->bindParam(":length", $game->length);
    $stmt->bindParam(":users_id", $game->users_id);
    $stmt->execute();
    $this->message->setMessage("Jogo adicionado com sucesso!", "success", "index.php");
  }

  public function update(Game $game) {
    $stmt = $this->conn->prepare("UPDATE games SET
      title = :title,
      description = :description,
      image = :image,
      category = :category,
      trailer = :trailer,
      length = :length
      WHERE id = :id      
    ");
    $stmt->bindParam(":title", $game->title);
    $stmt->bindParam(":description", $game->description);
    $stmt->bindParam(":image", $game->image);
    $stmt->bindParam(":category", $game->category);
    $stmt->bindParam(":trailer", $game->trailer);
    $stmt->bindParam(":length", $game->length);
    $stmt->bindParam(":id", $game->id);
    $stmt->execute();
    $this->message->setMessage("Jogo atualizado com sucesso!", "success", "dashboard.php");
  }

  public function destroy($id) {
    $stmt = $this->conn->prepare("DELETE FROM games WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $this->message->setMessage("Jogo removido com sucesso!", "success", "dashboard.php");
  }

  public function findById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM games WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $data = $stmt->fetch();
      $game = $this->buildGame($data);
      return $game;
    } else {
      return false;
    }
  }

  public function getLatestGames() {
    $games = [];
    $stmt = $this->conn->query("SELECT * FROM games ORDER BY id DESC");
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $gamesArray = $stmt->fetchAll();
      foreach($gamesArray as $game) {
        $games[] = $this->buildGame($game);
      }
    }
    return $games;
  }

  public function getGamesByCategory($category) {
    $games = [];
    $stmt = $this->conn->prepare("SELECT * FROM games WHERE category = :category ORDER BY id DESC");
    $stmt->bindParam(":category", $category);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $gamesArray = $stmt->fetchAll();
      foreach($gamesArray as $game) {
        $games[] = $this->buildGame($game);
      }
    }
    return $games;
  }

  public function getGamesByUserId($id) {
    $games = [];
    $stmt = $this->conn->prepare("SELECT * FROM games WHERE users_id = :users_id");
    $stmt->bindParam(":users_id", $id);
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $gamesArray = $stmt->fetchAll();
      foreach($gamesArray as $game) {
        $games[] = $this->buildGame($game);
      }
    }
    return $games;
  }

  public function findAll() {
    $games = [];
    $stmt = $this->conn->query("SELECT * FROM games");
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $gamesArray = $stmt->fetchAll();
      foreach($gamesArray as $game) {
        $games[] = $this->buildGame($game);
      }
    }
    return $games;
  }

  public function findByTitle($title) {
    $games = [];
    $stmt = $this->conn->prepare("SELECT * FROM games WHERE title LIKE :title");
    $stmt->bindValue(":title", '%' . $title . '%');
    $stmt->execute();
    if($stmt->rowCount() > 0) {
      $gamesArray = $stmt->fetchAll();
      foreach($gamesArray as $game) {
        $games[] = $this->buildGame($game);
      }
    }
    return $games;
  }

  public function getLatestMovies() {
    // Assuming 'Movies' is a typo and should be 'Games'
    return $this->getLatestGames();
  }

  public function getMoviesByCategory($category) {
    // Assuming 'Movies' is a typo and should be 'Games'
    return $this->getGamesByCategory($category);
  }

  public function getMoviesByUserId($id) {
    // Assuming 'Movies' is a typo and should be 'Games'
    return $this->getGamesByUserId($id);
  }
}
?>