<?php
include("connect.php");

if (isset($_POST['btnSend'])) {

  $userID =  $_POST['userID'];
  $content =  $_POST['content'];
  $privacy =  $_POST['privacy'];
  $cityID =  $_POST['cityID'];
  $provinceID = $_POST['provinceID'];


  $blogQuery = "
  INSERT INTO posts (userID, content, privacy, cityID, provinceID) 
  VALUES ('$userID', '$content', '$privacy', '$cityID', '$provinceID')";


  executeQuery($blogQuery);
}

$query = "
SELECT 
    p.*, 
    u.userID, 
    ui.firstName AS posterFirstName, 
    ui.lastName AS posterLastName, 
    c.cityName, 
    pr.provinceName,
    cm.content AS commentContent,
    cm.dateTime AS commentDateTime,
    uc.firstName AS commenterFirstName,
    uc.lastName AS commenterLastName
FROM 
    posts p
JOIN 
    users u ON p.userID = u.userID
JOIN 
    userinfo ui ON u.userInfoID = ui.userInfoID
JOIN 
    addresses a ON a.addressID = ui.addressID
JOIN 
    city c ON c.cityID = a.cityID
JOIN 
    provinces pr ON pr.provinceID = a.provinceID 
LEFT JOIN 
    comments cm ON p.postID = cm.postID
LEFT JOIN 
    users cu ON cm.userID = cu.userID
LEFT JOIN 
    userinfo uc ON cu.userInfoID = uc.userInfoID
";


$result = executeQuery($query);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Posts and Comments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid shadow mb-5 p-3">
    <h1>Social Media Posts</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card rounded-4 shadow my-3 mx-5">
              <div class="card p-4">
                <form method="post" class="row g-3">
                  <div class="col">
                    <input type="text" name="userID" class="form-control" placeholder="UserID" required>
                  </div>
                  <div class="col">
                    <input type="text" name="content" class="form-control" placeholder="Content" required>
                  </div>
                  <div class="col">
                    <input type="text" name="privacy" class="form-control" placeholder="Privacy">
                  </div>
                  <div class="col">
                    <input type="text" name="cityID" class="form-control" placeholder="City">
                  </div>
                  <div class="col">
                    <input type="text" name="provinceID" class="form-control" placeholder="Province">
                  </div>
                  <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary w-50" name="btnSend">Post</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php


      if (mysqli_num_rows($result)) {
        /*  $i = 1; */
        while ($user = mysqli_fetch_assoc($result)) {
      ?>

          <div class="col-12">
            <?php /* echo $i++  */ ?>
            <div class="card rounded-4 shadow my-3 mx-5">
              <div class="card-body">
                <h5 class="card-title">
                  <?php echo $user["posterFirstName"] . " " . $user["posterLastName"]; ?>
                  <span class="text-muted ms-2">Privacy: <?php echo $user['privacy']; ?></span>
                </h5>

                <h6 class="card-subtitle mb-2 text-body-secondary">
                  <?php echo $user["cityName"] . ", " . $user["provinceName"]; ?>
                </h6>
                <p class="card-text"><?php echo $user['content']; ?></p>
                <p class="card-text"><small class="text-muted"><?php echo $user['dateTime']; ?></small></p>
              </div>
            </div>

            <?php if ($user['commentContent']) { ?>
              <div class="card rounded-4 shadow my-2 mx-5">
                <div class="card-body">
                  <h6 class="card-subtitle mb-2 text-body-secondary">
                    <?php echo $user['commenterFirstName'] . " " . $user['commenterLastName']; ?>
                    <small class="text-muted">(<?php echo $user['commentDateTime']; ?>)</small>
                  </h6>
                  <p class="card-text"><?php echo $user['commentContent']; ?></p>
                </div>
              </div>
            <?php } ?>
          </div>

      <?php
        }
      }
      ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>