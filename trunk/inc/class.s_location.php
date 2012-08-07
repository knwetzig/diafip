<?php
/***************************************************************
Klassenbibliotheken für die Werwaltung von Orten (Personen/
Lagermöglichkeiten)

$Rev::                         $:  Revision der letzten Übertragung
$Author::                      $:  Autor der letzten Übertragung
$Date::                        $:  Datum der letzten Übertragung
$URL$

ToDo:
***** (c) DIAF e.V. *******************************************/

/** =================================================================
                            ORTE KLASSE
================================================================= **/
/**********************************************************
func: __construct($)
    ::getOrt($!)    // holt die Ortsdaten aus der Ortstabelle -> array
      get()        // --dito-- schreibt dies aber ins Objekt
      neu()
      edit()
      set()      // schreibt objekt -> db
    ::getOrtList()  // listet alle Orte in einem Array

Anm.:
    Die Liste mit den Staaten und Ländern wird händisch geflegt

    Orte die nicht verknüpft sind werden automatisch nach einer gewissen
    Zeit gelöscht. -- muss noch implementiert werden --
**********************************************************/
class Ort {
protected
    $id     = null,
    $lid    =    1, // Landeskennung
    $ort    = null,
    $land   = null,
    $bland  = null;

function __construct($nr = NULL) {
    if (isset($nr) AND ($nr>0)) {
        $this->id = $nr;
        $this->get();
    }
    else $this->neu(false);
}

protected function get() {    // die dynamische Version
    global $db;
    $sql = 'SELECT * FROM orte WHERE id = ?;';
    $data = $db->extended->getRow($sql, null, array($this->id));
    IsDbError($data);
    // ACHTUNG: Die Kombination mit einem statischen Aufruf führt zum
    // Überschreiben von Speicherinhalten!!!
    // deswegen gibt es diese 2 Versionen
    foreach($this as $key => &$wert) $wert = $data[$key];
    unset($wert);
}

function getOrt($nr) {  // die statische Version
    global $db;
    $sql = 'SELECT * FROM orte WHERE id = ?;';
    $data = $db->extended->getRow($sql, null, array($nr));
    IsDbError($data);
    return  $data;
}

function neu($status) {
/****************************************************************
Aufgabe: Neuanlage einer Location
Aufruf: false   für Erstaufruf
        true    Verarbeitung nach Formular
****************************************************************/
    global $db;

    if($status == false) {
        $this->edit(false);
    } else {
        $this->edit(true);
        $data = $db->extended->autoExecute('s_orte', array(
                'ort' => $this->ort,
                'land' => $this->lid),
            MDB2_AUTOQUERY_INSERT, null, array(
                'text',
                'integer'));
        IsDbError($data);
        return 0;
    }
}

function edit($status) {
    global $db, $smarty;
    if($status == false) {
        $smarty->assign('llist', self::getLandList());
        $data = a_display(array(
            // name, inhalt optional-> rechte, label, tooltip, valString
            new d_feld('ort',$this->ort, SEDIT),
            new d_feld('lid',$this->lid)));
        $smarty->assign('dialog', $data);
        $smarty->display('adm_ortedialog.tpl');
    } else {
        // Formular auswerten und in Obj speichern
        if(isset($_POST['ort'])) {
            if(isValid($_POST['ort'], NAMEN))
                $this->ort = normtext($_POST['ort']);
            else {
                fehler(107);
                die();
            }
        }
        $this->lid = (int)$_POST['land'];
    }
}

function set() {
/*************************************************************
 Aufgabe: schreibt das Obj. via Update in die DB zurück
 Return: 0  alles ok
         1  leerer Datensatz
**************************************************************/
    global $db;
    if (!$this->id) return 1;   // Abbruch weil leerer Datensatz
    $types = array('integer','text');
    $werte = array('land' => $this->lid, 'ort' => $this->ort);
    $data = $db->extended->autoExecute('s_orte', $werte, MDB2_AUTOQUERY_UPDATE,
        'id = '.$db->quote($this->id, 'integer'), $types);
    IsDbError($data);
    return 0;
}

function getOrtList() {
// listet alle Orte in einem Array
    global $db;
    $sql = 'SELECT * FROM orte;';
    $data = $db->extended->getAll($sql);
    IsDbError($data);
    $orte=array('-- unbekannt --');
    foreach($data as $val) { // val ist das Städtearray
        $orte[$val['id']] = $val['ort'];
    }
    return $orte;
}

function getLandList() {
    global $db;
    $sql = 'SELECT * FROM s_land ORDER BY s_land.land ASC, s_land.bland ASC;';
    $data = $db->extended->getAll($sql);
    IsDbError($data);
    $laend = array();
    foreach($data as $val) {
        $laend[$val['id']] = $val['bland']."&nbsp;-&nbsp;".$val['land'];
    }
    return $laend;
}
}   //endclass;
?>