<?php
include("connect.php");

// Updated SQL Query
$query = "
SELECT p.*, 
       u.userID, 
       ui.firstName AS posterFirstName, 
       ui.lastName AS posterLastName, 
       p.content AS postContent,  
       p.dateTime AS postDateTime, 
       c.cityName, 
       pr.provinceName,
       cm.content AS commentContent,
       cm.dateTime AS commentDateTime,
       uc.firstName AS commenterFirstName,
       uc.lastName AS commenterLastName
FROM posts p 
JOIN users u ON p.userID = u.userID 
JOIN userinfo ui ON u.userInfoID = ui.userInfoID 
JOIN city c ON p.cityID = c.cityID 
JOIN provinces pr ON p.provinceID = pr.provinceID 
LEFT JOIN comments cm ON p.postID = cm.postID 
LEFT JOIN users cu ON cm.userID = cu.userID 
LEFT JOIN userinfo uc ON cu.userInfoID = uc.userInfoID 
WHERE p.isDeleted = '0'";


$result = executeQuery($query);
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts and Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="socialMedia.css">
</head>

<body>

<div class="container-fluid shadow mb-5 p-3 text-center">
    <h1>Social Media Posts</h1>
</div>


    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center">

            <?php
            if (mysqli_num_rows($result)) {
                while ($user = mysqli_fetch_assoc($result)) {
            ?>

                    <div class="col-12 rounded-4  my-3 mx-5">
                        <div class="card">
                            <div class="d-flex justify-content-between p-2 px-3">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-flex flex-column ml-2">
                                        <h5 class="card-title">
                                            <?php echo $user["posterFirstName"] . " " . $user["posterLastName"] ?>
                                        </h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">
                                            <?php
                                            echo $user["cityName"] . ", " . $user["provinceName"];
                                            ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2"><?php echo $user["postDateTime"] ?></small> <i class="fa fa-ellipsis-h"></i> </div>
                            </div>
                            <div class="p-2">
                            <p class="text-justify mb-2"><strong><?php echo htmlspecialchars($user["postContent"]); ?></strong></p>

                                <hr>
                                <div class="d-flex align-items-center">
    <div class="d-flex flex-row icons align-items-center">
        <i class="fa fa-heart"></i>
        <i class="fa fa-smile-o ml-2"></i>
    </div>
    <div class="d-flex flex-row ml-2"> 
        <span>COMMENTS</span>
    </div>
</div>

                                <hr>
                                <div class="comments">
                                    <div class="d-flex flex-row mb-2">
                                        <div class="d-flex flex-column ml-2"> <span class="name"><?php echo $user["commenterFirstName"] . " " . $user["commenterLastName"] ?></span> <small class="comment-text"><?php echo $user["commentContent"] ?></small>
                                            <div class="d-flex flex-row align-items-center status"> <small>Like</small> <small>Reply</small> <small>Translate</small> <small><?php echo $user["commentDateTime"] ?></small> </div>
                                        </div>
                                    </div>
                                    <div class="comment-input"> <input type="text" class="form-control">
                                        <div class="fonts"> <i class="fa fa-camera"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



            <?php
                }
            }
            ?>




        </div>
    </div>

</body>

</html>