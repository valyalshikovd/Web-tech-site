<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дмитрий Валяльщиков</title>
    <link rel="stylesheet" href="../../../public/styles/navbar.css" >
    <link rel="stylesheet" href="../../../public/styles/main.css" >
    <link rel="stylesheet" href="../../../public/styles/form.css">
    <link rel="stylesheet" href="../../../public/styles/basic.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <script src="../../../public/scripts/jquery.js"></script>
    <script src="../../../public/scripts/form.js"></script>
    <script src="../../../public/scripts/popper.js"></script>
</head>

<body>
<div class="navbar">
    <button class="navbtn">&#9776</button>
    <div class="nav-list">
        <a href="../../admin/addPost">Добавить пост</a>
        <a href="../../admin/posts">Просмотреть посты</a>
        <a href="../../admin/logout">Выйти</a>
    </div>
    <div class="numberphone">
        <a href="../../login">Дмитрий Валяльщиков</a>
    </div>
</div>
<?php echo $content ?>
</body>

</html>
