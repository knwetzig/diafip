{**************************************************************
    Enthält die statische Menüstruktur im linken Bereich
    der Seite

$Rev$
$Author$
$Date$
$URL$

***** (c) DIAF e.V. *******************************************}

<div id='menue'>
    <form action='index.php' method='get'>
        <button class='noBG'><img src='images/diaf.png' alt='DIAF' /></button>
        <br /><br />
        <button name='sektion' value='person'>{$dlg[3]}</button>
        <button name='sektion' value='film'>{$dlg[1]}</button>
        <button name='sektion' value='i_planar'>{$dlg[2]}</button>
        <button name='sektion' value='i_3dobj'>{$dlg[8]}</button>
        <button name='sektion' value='i_fkop'>{$dlg[9]}</button>
        <button name='sektion' value='news'>{$dlg[4]}</button>
        <button name='sektion' value='admin'>{$dlg[6]}</button><br />
        <button class='flag' name='aktion' value='de'>
            <img src='images/flag-german.png' alt='de' />
        </button>
        <button class='flag' name='aktion' value='en'>
            <img src='images/flag-english.png' alt='en' />
        </button>
        <button class='flag' name='aktion' value='fr'>
            <img src='images/flag-french.png' alt='fr' />
        </button><br />
        <span class='note' style='padding-top:15px;'><br />{$dlg[99]}<br /></span>
        <button name='aktion' value='logout'>{$dlg[5]}</button>
    </form>
</div>