<?php

    require_once("models/User.php");

    $userModel = new User();

    $fullName = $userModel->getFullName($review->user);

    // Checar se o filme tem imagem
    if($review->user->image == "") {
      $review->user->image = "user.png";
    }

?>
<div class="review">
  <div class="user-info">
    <div class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $review->user->image ?>')"></div>
    <div class="user-name">
      <h5><?= $review->user->name ?></h5>
    </div>
  </div>
  <div class="review-content">
    <h6>Nota: <?= $review->rating ?></h6>
    <p><?= $review->review ?></p>
  </div>
</div>