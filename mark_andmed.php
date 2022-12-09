<?php
session_start();
if (!isset($_SESSION['tuvastamine'])) {
    header('Location: ab_login_Mark.php');
    exit();
}
require_once ('connect_mark.php');
global $baas;
//andmete lisamine tabelisse
if (isset($_REQUEST['lisavorm']) && !empty($_REQUEST['nimi'])){
    $sql=$baas->prepare("INSERT INTO lilled(nimi,hind,varv) VALUE (?,?,?)");
    $sql->bind_param("sds",$_REQUEST["nimi"],$_REQUEST["hind"],$_REQUEST["varv"]);
    //sdi, s -string, d-double, i - integer
    $sql->execute();
}
if(isset($_REQUEST['kustutavorm'])){
    $sql=$baas->prepare("DELETE FROM lilled WHERE id=?");
    $sql->bind_param('i',$_REQUEST['kustutavorm']);
    $sql->execute();
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Lilled</title>
    <link rel="stylesheet" type="text/css" href="style_mark.css">
</head>
<header>
    <div>
        <?php
        //session_start();
        echo $_SESSION['kasutaja'];
        ?> on sisse logitud
        <form action="logout_Mark.php" method="post">
            <input type="submit" value="Logi välja" name="logout">
        </form>
    </div>
</header>
<body>
<h1>Mark Andebaas "lilled"</h1>
<div id="pohi">
    <ul>
        <?php
        $sql=$baas->prepare("SELECT id, nimi FROM lilled");
        $sql->bind_result($id,$nimi);
        $sql->execute();
        //näitab loomade loetelu tabelist loomad
        while ($sql->fetch()) {
            echo "<li><a href='?id=$id'>".$nimi."</a></li>";
        }
        echo "</ul>";
        echo "<a href='?lisalill=jah'>Lisa lill</a>";
        echo "<br>";
        echo "<a href='https://github.com/GermanVassiljev/Mark-AB'>github</a>";
        ?>
</div>
<div id="andmed">
<div id="andmed_style">
<?php
if(isset($_REQUEST["id"])){
    $sql=$baas->prepare("SELECT nimi, hind, varv FROM lilled WHERE id=?");
    $sql->bind_param('i',$_REQUEST['id']);
    //? küsimärki asemel aadressiribalt tuleb id
    $sql->bind_result($nimi,$hind,$varv);
    $sql->execute();
    if ($sql->fetch()){
        echo "<div><style>div#andmed_style{border:5px solid $varv}</style>"."Nimi: ".htmlspecialchars($nimi);
        echo "<br>";
        echo "Hind: ".htmlspecialchars($hind)." €";
        echo "<br>Värv: ".htmlspecialchars($varv);
        echo "<br>";
        echo "<br> <a href='?kustutavorm=".$_REQUEST['id']."'>Kustuta</a>";
        echo "</div>";

    }
    else {
        echo "<h3>Siia tuleb loomade info....</h3>";
    }
}
?>
</div>
    <?php

    if (isset($_REQUEST["lisalill"])){
    ?>
    <div id="lisa_andmed">
    <h2>Lisa uue lilled</h2>
    <form name="uuslill" method="post" action="?">
        <input type="hidden" name="lisavorm" value="jah">
        <input type="text" name="nimi" placeholder="lilled nimi">
        <input type="number" step="0.01" name="hind" placeholder="Kui palju maksab">
        <input type="color" name="varv" placeholder="Sisesta lilled värv">
        <br>
        <br>
        <input type="submit" value="OK" id="sub">
    </form>
    </div>
    <?php
    }

    ?>
</div>
</body>
</html>

