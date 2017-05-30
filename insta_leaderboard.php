<?php

    session_start();

    function get_data($uri){

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = json_decode(curl_exec($curl));

        return $result;

    }

    $usr_info = get_data('https://api.instagram.com/v1/users/self/?access_token='.$_SESSION['access_token']);
    $usr_media = get_data('https://api.instagram.com/v1/users/self/media/recent/?access_token='.$_SESSION['access_token']);
    // var_dump($usr_media);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Insta-Leaderboard</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row main-content">
            <div class="row header centered">
                <div><img class="profile-picture" src="<?=$usr_info->data->profile_picture?>" alt="Profile picture"></div>
                <div class="row info-box">
                    <div class="row full-name"><?=$usr_info->data->full_name?></div>
                    <div class="row username"><a href="https://www.instagram.com/<?=$usr_info->data->username?>/">@<?=$usr_info->data->username?></a></div>
                    <div class="row boxes bio">
                        <span class="bio-content"><?=$usr_info->data->bio?></span>
                        <span class="bio-content"><b>Website:</b> <a href="<?=$usr_info->data->website?>"><?=$usr_info->data->website?></a></span>
                    </div>
                    <div class="row boxes count-box">
                        <div class="col-lg-4"><?=$usr_info->data->counts->media?><br><b>Posts</b></div>
                        <div class="col-lg-4"><?=$usr_info->data->counts->follows?><br><b>Following</b></div>
                        <div class="col-lg-4"><?=$usr_info->data->counts->followed_by?><br><b>Followers</b></div>
                    </div>
                    <div class="row boxes media-box">
                        <?php foreach($usr_media->data as $media): ?>
                            <img class="media" src="<?=$media->images->standard_resolution->url?>" alt="">
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>