<?php
    $link = mysqli_connect('localhost', 'root', '', 'gallerytest') or
    die(mysqli_error($link));

    if(!empty($_GET['action']) && ($_GET['action'] == 'showImg') && !empty($_GET['id'])) {
        $idImg = $_GET['id'];
        $sql = "UPDATE images SET count = count + 1 WHERE id = " . $idImg;
        $res = mysqli_query($link, $sql);
        header('location: ?action=showGallery');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Галерея</title>
    <style>
        .galleryWrapper__screen{
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #222;
            opacity: 0.8;
            position: fixed;
            top: 0;
            z-index: 100;
            display: block;
            text-align: center;
        }
        .galleryWrapper__image {
            max-height: 80%;
            max-width: 80%;
            z-index: 101;
            position: absolute;
            margin: auto;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
        }
        .galleryWrapper__close {
            z-index: 101;
            position: absolute;
            top: 0;
            right: 0;
        }

        .galleryWrapperPrev {
            z-index: 102;
            position: absolute;
            top: 50%;
            left: 5%;
            transform: scale(4);
            cursor: pointer;
        }

        .galleryWrapperNext {
            z-index: 102;
            position: absolute;
            top: 50%;
            right: 5%;
            transform: scale(4);
            cursor: pointer;
        }

    </style>
</head>
<body>
<div class="galleryPreviewsContainer">
    <?php
        if(!empty($_GET['action'])
        && ($_GET['action'] == 'showGallery')):
            $sql = "SELECT * FROM images";
            $res = mysqli_query($link, $sql);
            while ($row = mysqli_fetch_assoc($res)):
    ?>
                <a href="?action=showImg&id=<?=$row['id']?>">
                    <img src="<?=$row['minSrc']?>" data-full_image_url="<?=$row['fullSrc']?>" alt="<?=$row['alt']?>">
                </a>
    <?php endwhile;
        endif;
        ?>
</div>
<form>
    <button id="show-img" value="showGallery" name="action">Show gallery</button>
</form>


<!-- <div class="galleryWrapper">
  <div class="galleryWrapperPrev">&#8249;</div>
  <div class="galleryWrapperNext">&#8250;</div>
  <div class="galleryWrapper__screen"></div>
  <img class="galleryWrapper__close" src="images/gallery/close.png" alt="">
  <img class="galleryWrapper__image" src="images/max/1.jpg" alt="">
</div> -->
<script src="js.js"></script>

</body>
</html>
