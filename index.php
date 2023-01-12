<?php
$pageTitle = 'Pagina principala';
require_once dirname(__FILE__) . "/php-parse-html/scrapeFirstPageVideo.php";
?>
<!doctype html>
<html lang="en">
    <?php include 'templates/head.php';?>
    <body>
        <?php include 'templates/menu.php';?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h5>Pagina principala - o scurta istorie a spitalelor</h5>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <p>Sursa: <a href="https://ro.wikipedia.org/wiki/Spital">Wikipedi</a></p>
                </div>
            </div>
        </div>
        <?php
            $i = 0;
            foreach ($ps as $p) {
                $i++;
                if ($i == 7) {
                    break;
                }
                $text = $p->textContent;
                echo preg_replace("/\[\d+]/", "", $text);
        ?>
                <br>
                <br>
        <?php } ?>
    </body>
</html>