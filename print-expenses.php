<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Relatório de despesas</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />

    </head>
    <body class="white">
        <main>
            <div id="content-print" class="content">
                <div id="content" class="content-print">
                    <?php
                        include_once 'classes/database.php';
                        include_once 'layout/report-expenses.php';
                    ?>
                </div>
            </div>
        </main>
    </body>
</html>
