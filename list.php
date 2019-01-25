<?
require 'vendor/autoload.php';
\Mirafox\OnlineTest\Application::getInstance()->start();
$results = (new \Mirafox\OnlineTest\Models\TestResult())->getAll();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row" id="resultTable">
        <div class="col-md-12">
            <br>
            <a href="/">Назад к тестированию</a>
            <br><br>
            <?if(count($results) == 0):?>
                <br><br>
                Результатов еще нет
            <?else:?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Порядковый номер тестирования</th>
                    <th scope="col">Интеллект тестируемого</th>
                    <th scope="col">Диапазон сложности вопросов</th>
                    <th scope="col">Результат тестирования</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($results as $result):?>
                    <tr>
                        <th scope="row"><?=$result->id?></th>
                        <td><?=$result->user_intellect?></td>
                        <td><?=$result->min_difficult?> - <?=$result->max_difficult?></td>
                        <td><?=$result->correct_answers_count?> из <?=$result->questions_count?></td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
        <?endif;?>
    </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>