<?php
if ($_REQUEST['AJAX'] == 'Y') {
    require 'vendor/autoload.php';
    \Mirafox\OnlineTest\Application::getInstance()->start();
    $test = new \Mirafox\OnlineTest\Models\Test($_REQUEST['FORM'][0]['value'], $_REQUEST['FORM'][1]['value'], $_REQUEST['FORM'][2]['value']);
    $results = $test->passTest();
}
?>
<?if ($_REQUEST['AJAX'] == 'Y'):?>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Порядковый номер вопроса</th>
            <th scope="col">ID вопроса по БД</th>
            <th scope="col">Количество тестов, в которых этот вопрос ранее встречался</th>
            <th scope="col">Сложность вопроса</th>
            <th scope="col">Правильный ответ</th>
        </tr>
    </thead>
    <tbody>
        <?foreach ($results['ANSWERS'] as $result):?>
        <tr>
            <th scope="row"><?=$result['NUM']?></th>
            <td><?=$result['ID']?></td>
            <td><?=$result['SHOWS_COUNT']?></td>
            <td><?=$result['QUESTION_DIFFICULTY']?></td>
            <td><?=$result['RESULT']?></td>
        </tr>
        <?endforeach;?>
    </tbody>
</table>
Тестируемый ответил правильно на <?=$results['CORRECT_ANSWERS']?> вопросов из <?=$results['QUESTION_COUNT']?>.
<br><br>
<?else:?>
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
        <div class="row">
            <div class="col-md-12">
            <br>
            <a href="/list.php">Список результатов</a>
            <br><br>
            <form action="/" method="post" id="test">
                <div class="form-group">
                    <label for="mindifficulty">Минимальная сложность вопроса</label>
                    <input type="number" class="form-control" id="mindifficulty" name="mindifficulty" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="maxdifficulty">Максимальная сложность вопроса</label>
                    <input type="number" class="form-control" id="maxdifficulty" name="maxdifficulty" required>
                </div>
                <div class="form-group">
                    <label for="userIntelect">Интелект тестируемого</label>
                    <input type="number" class="form-control" id="userIntelect" name="userIntelect" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit_btn">Тестировать</button>
            </form>
            </div>
        </div>
        <br><br>
        <div class="row" id="resultTable">

        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?endif;?>
