<?php
/***************************************************************

    Das Ladeprogramm für die Hauptseite
    Hier wird nur die "sektion" Fraktion ausgewertet

$Rev::                         $:  Revision der letzten Übertragung
$Author::                      $:  Autor der letzten Übertragung
$Date::                        $:  Datum der letzten Übertragung
$URL$

Anm.: Schreibe 'sektion' und nicht 'section'!!!
***** (c) DIAF e.V. *******************************************/

    echo "<div id='main'>";

    if(isset($_POST['sektion']) AND isset($datei[$_POST['sektion']])) {
        include $datei[$_POST['sektion']];
    } else {
        include 'default.php';
    }
    echo "</div>";
?>