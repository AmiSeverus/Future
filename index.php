<?php
    $db = mysqli_connect('localhost', 'root', 'root', 'future');

    switch ($_SERVER['REQUEST_METHOD']){
        case 'POST':
            if (trim($_POST['name']) != "" && trim($_POST['comment'])){
                mysqli_query($db, "insert into posts (name, text)values('" . $_POST['name'] . "','" . $_POST['comment'] . "')");
            };
            header('Location: http://test/future/');
            break;
        case 'GET':
            $posts = mysqli_fetch_all(mysqli_query($db, 'select * from posts'));
            if (!$posts){
                $posts = [];
            };
            break;
    };
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Future</title>
</head>
<body>
    <header>
        <div class='headContainer'>
            <div class='headContainer_content'>
                <div class='headContainer_contacts'>
                    <div>
                        <p class='phone'><a href='tel:+74993409471'>Телефон: (499) 340-94-71</a></p>
                        <p class='email'><a href='mailto:info@future-group.ru'>Email: <span>info@future-group.ru</span></a></p>                        
                    </div>    
                </div>
                <div class='headContainer_text'>
                    <h3>Комментарии</h3>
                </div>
            </div>
            <div class='headContainer_logo'>
                <img src="./img/Logo.png" alt="logo">
            </div>
        </div>
    </header>
    <div class="article">
        <div class='mainContainer'>
            <div class='mainContainer_comments'>
                <?php foreach ($posts as $post) { ?>
                <div class='mainContainer_item'>
                    <div class='mainContainer_header'>
                        <div class='mainContainer_name'><?= $post[1]?></div>
                        <div class='mianContainer_datetime'><?php 
                        $stamp = date_create_from_format('Y-m-d H:i:s', $post[3]);
                        echo date_format($stamp, 'H:i  d.m.Y') ?>
                        </div>
                    </div>
                    <p class='mainContainer_comment'><?= $post[2]?></p>
                </div>
                <?php }?>
            </div>
            <div class='mainContainer_input'>
                <form action="index.php" method="post">
                    <h3>Оставить комментарий</h3>
                    <span>Ваше имя</span>
                    <input class='name' autocomplete='off' type='text' name='name' required>
                    <span>Ваш комментарий</span>
                    <textarea class='comments' name='comment' required></textarea>
                    <div class='submitWrapper'>
                        <input class='submit' type='submit' value='Отправить'>
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <div class='end'>
        
    </div>
    <!--<div class='footer'>
        <div class='footContainer'>
            <img src="./img/Logo.png" alt="logo">
            <div class='footContainer_info'>
                <div class='footContainer_details'>
                    <div class='footContainer_wrapper'>
                        <p class='phone'><a href='tel:+74993409471'>Телефон: (499) 340-94-71</a></p>
                        <p class='email'><a href='mailto:info@future-group.ru'>Email: <span>info@future-group.ru</span></a></p>
                        <p class='address'>Адрес: <span>115088 Москва, ул. 2-я Машиностроения, д.7 стр. 1</span></p>
                        <p class='rights'>&commat; 2010 - 2014 Future. Все права защищены </p>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
</body>
</html>