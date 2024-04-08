<?php use controller\PicasFijasController;
require_once 'controller/PicasFijasController.php';
session_start();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>
        Picas - Fijas
    </title>
    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<form method="POST" action="">
    <div id="secretListNumDiv">
        <label for="secretListNum">Número secreto: </label>
        <input type="text" id="secretListNum" name="secretListNum">
    </div>
    <br>
    <div id="ListNumDiv">
        <label for="listNum">Número:</label>
        <input type="text" name="listNum">
    </div>
    <br>
    <button id="secretBtn">Ocultar secreto</button>
    <button id="resetBtn">Reiniciar juego</button>
    <input type="submit" value="Enviar">
</form>

<div>
    <p id="alertMessage"></p>
</div>

<?php
    if (isset($_POST['listNum'])) {
        $picasFijasController = new PicasFijasController();
        $message = $picasFijasController->seeAllMatches(strval($_POST['secretListNum']), strval($_POST['listNum']));
    }
?>

<script>
        window.addEventListener('load', function(){
            let secretBtn = document.getElementById('secretBtn');
            let resetBtn = document.getElementById('resetBtn');
            let secretListNumDiv = document.getElementById('secretListNumDiv');
            let secretListNum = document.getElementById('secretListNum');
            let alertMessage = document.getElementById('alertMessage');

            alertMessage.innerHTML = '<?php echo $message; ?>'

            <?php
                if (isset($_SESSION['secret'])) {
            ?>
                secretListNum.value = <?= $_SESSION['secret'] ?> ;
                secretBtn.style.display = 'none';
                secretListNumDiv.style.display = 'none';
            <?php
                }
            ?>

            secretBtn.addEventListener('click', function(event){
                event.preventDefault();
                if ((secretListNum.value.length === 4)) {
                    secretBtn.style.display = 'none';
                    secretListNumDiv.style.display = 'none';
                }
            });

            resetBtn.addEventListener('click', function(event){
                <?php
                    unset($_SESSION['secret']);
                ?>
            });
        });
</script>
</body>
</html>