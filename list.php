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
<?php
$string = file_get_contents(__DIR__.'\test.json');
$data = json_decode($string, true);
foreach ($data as $i => $test_data) {
    echo '<a href="test.php?index='.$i.'">'.'тест: '.$test_data["testName"].'</a>'.'<br/>';
}
?>
</body>
</html>
