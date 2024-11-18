<?php

require_once("globals.php");
require_once("db.php");
require_once("models/Game.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("dao/GameDAO.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$gameDao = new GameDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");
$userData = $userDao->verifyToken();

if($type === "create") {
  $title = filter_input(INPUT_POST, "title");
  $description = filter_input(INPUT_POST, "description");
  $trailer = filter_input(INPUT_POST, "trailer");
  $category = filter_input(INPUT_POST, "category");
  $length = filter_input(INPUT_POST, "length");

  $game = new Game();

  if(!empty($title) && !empty($description) && !empty($category)) {
    $game->title = $title;
    $game->description = $description;
    $game->trailer = $trailer;
    $game->category = $category;
    $game->length = $length;
    $game->users_id = $userData->id;

    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
      $image = $_FILES["image"];
      $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
      $jpgArray = ["image/jpeg", "image/jpg"];

      if(in_array($image["type"], $imageTypes)) {
        if(in_array($image["type"], $jpgArray)) {
          $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        } else {
          $imageFile = imagecreatefrompng($image["tmp_name"]);
        }

        $imageName = $game->imageGenerateName();
        imagejpeg($imageFile, "./img/games/" . $imageName, 100);
        $game->image = $imageName;
      } else {
        $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
      }
    }

    $gameDao->create($game);
  } else {
    $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
  }
} else if($type === "update") {
  $title = filter_input(INPUT_POST, "title");
  $description = filter_input(INPUT_POST, "description");
  $trailer = filter_input(INPUT_POST, "trailer");
  $category = filter_input(INPUT_POST, "category");
  $length = filter_input(INPUT_POST, "length");
  $id = filter_input(INPUT_POST, "id");

  $gameData = $gameDao->findById($id);

  if($gameData) {
    if($gameData->users_id === $userData->id) {
      if(!empty($title) && !empty($description) && !empty($category)) {
        $gameData->title = $title;
        $gameData->description = $description;
        $gameData->trailer = $trailer;
        $gameData->category = $category;
        $gameData->length = $length;

        if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
          $image = $_FILES["image"];
          $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
          $jpgArray = ["image/jpeg", "image/jpg"];

          if(in_array($image["type"], $imageTypes)) {
            if(in_array($image["type"], $jpgArray)) {
              $imageFile = imagecreatefromjpeg($image["tmp_name"]);
            } else {
              $imageFile = imagecreatefrompng($image["tmp_name"]);
            }

            $imageName = $game->imageGenerateName();
            imagejpeg($imageFile, "./img/games/" . $imageName, 100);
            $gameData->image = $imageName;
          } else {
            $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
          }
        }

        $gameDao->update($gameData);
      } else {
        $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
      }
    } else {
      $message->setMessage("Informações inválidas!", "error", "index.php");
    }
  } else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
  }
} else if($type === "delete") {
  $id = filter_input(INPUT_POST, "id");
  $game = $gameDao->findById($id);

  if($game) {
    if($game->users_id === $userData->id) {
      $gameDao->destroy($game->id);
    } else {
      $message->setMessage("Informações inválidas!", "error", "index.php");
    }
  } else {
    $message->setMessage("Informações inválidas!", "error", "index.php");
  }
} else {
  $message->setMessage("Informações inválidas!", "error", "index.php");
}
?>