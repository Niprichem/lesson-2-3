<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
    <form enctype="multipart/form-data" action="/admin.php" method="POST">
        JSON-файл c тестом: <input name="testfile" type="file" /> <br />
        <input type="submit" value="Отправить">
    </form>
<?php }
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES)) {
        if (array_key_exists("testfile", $_FILES)) {
            if (move_uploaded_file($_FILES["testfile"]["tmp_name"], "test.json")) {
                header('Location: list.php');
            } else {
                echo "Что то пошло не так";
            }
        }
    }
}
else {
    echo 'Request method undefined. Use "GET" or "POST".';
}
?>

</body>
</html>
