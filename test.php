<?php
$string = file_get_contents(__DIR__.'\test.json');
$tests_data = json_decode($string, true);
$test_index = null;
$username_name = 'username';
if (isset($_GET['index'])) {
    $test_index = htmlspecialchars(($_GET['index']));
}
if ($test_index === null) {
    echo 'error: index undefined';
}
if (!$tests_data[$test_index]) {
    header("HTTP/1.0 404 Not Found");
}
elseif ($_SERVER['REQUEST_METHOD'] == 'GET') { ?>
    test: <?php echo $tests_data[$test_index]['testName'] ?><br\>
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
    <form action='' method='POST'>
        введите ваше имя
        <input type="text" name="<?php echo $username_name ?>">
        <?php foreach ($tests_data[$test_index]['questions'] as $question) { ?>
            <fieldset>
            <legend><?php echo $question['question'] ?></legend>
            <?php foreach ($question['answers'] as $i => $answer) { ?>
                <label><input type="checkbox" name="<?php echo $question['title'] ?>[]" value="<?php echo $i ?>"><?php echo $answer ?></label>
            <?php } ?>
            </fieldset>
        <?php } ?>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>
<?php }
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = 0;
    foreach ($tests_data[$test_index]['questions'] as $i => $question_data) {
        if ($tests_data[$test_index]['questions'][$i]['result'] == $_POST[$tests_data[$test_index]['questions'][$i]['title']]) {
            $result += 1;
        }
    }
    $username = $_POST[$username_name];
    if (!$username) {
        throw new Exception('Error: Fill in your name');
    }
    $text = $username.' result: '.$result.' from '.count($tests_data[$test_index]);
    header("Content-type: image/png");
    $im = imagecreatetruecolor(400, 30);
    $white = imagecolorallocate($im, 255, 255, 255);
    $black = imagecolorallocate($im, 0, 0, 0);
    imagefilledrectangle($im, 0, 0, 400, 30, $white);
    imagestring($im, 5, 0, 0, $text, $black);
    imagepng($im);
    imagedestroy($im);
}
else {
    echo 'Request method undefined. Use "GET" or "POST".';
} ?>
