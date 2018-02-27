<?php
// MySQL Abfragen

function pdo_insert($dbc, $table, $values) {
   
   $val1 = '';
   $val2 = '';
   $val3 = array();
   
   foreach($values as $val) {
      $val1 .= $val.', ';
      $val2 .= ':'.$val.', ';
      $val3[':'.$val] = $_POST[$val];
   }
   $val1 = substr($val1, 0, -2);
   $val2 = substr($val2, 0, -2); 
   
   $q = "INSERT INTO $table ($val1) VALUES ($val2)";
   $r = $dbc->prepare($q); 
   $r->execute($val3);
   
   return $dbc->lastInsertId(); // $q;
}

function pdo_select($dbc, $table, $where) {
   
   if($where == "") {
      $q = "SELECT * FROM $table";
   } else {
      $q = "SELECT * FROM $table WHERE $where";
   }
   $r = $dbc->prepare($q); 
   $r->execute();

   return $r->fetchAll(PDO::FETCH_ASSOC);
}

function pdo_query($dbc, $q) {
   $r = $dbc->prepare($q); 
   $r->execute();

   return $r->fetchAll(PDO::FETCH_ASSOC);
}

function pdo_query1($dbc, $q) {
   $x = "select * from PersonenAktiv WHERE (Vorname like '%özb%' OR Name LIKE '%özb%') or (Vorname like '%özb%' AND Name LIKE '%özb%') or Mitarbeiter like '%özb%'  order by Name, Vorname";
   $r = $dbc->prepare($x); 
   $r->execute();

   return $r->fetchAll(PDO::FETCH_ASSOC);
}

function pdo_groupquery($dbc, $q) {
   $r = $dbc->prepare($q); 
   $r->execute();

   return $r->fetchAll(PDO::FETCH_GROUP);
}

function pdo_update($dbc, $table, $values, $where) {

   $val12 = '';
   $val3 = array();
   
   foreach($values as $val) {
      $val12 .= $val.' = :'.$val.', ';
      $val3[':'.$val] = $_POST[$val];
   }
   $val12 = substr($val12, 0, -2);
      
   $q = "UPDATE $table SET $val12 WHERE $where";
   $r = $dbc->prepare($q); 
   $r->execute($val3);

   return $dbc->lastInsertId();
}

function pdo_delete($dbc, $table, $id1, $id2) {
   $val = array();
   $val[':'.$id1] = $id2;

   $q = "DELETE FROM $table WHERE ".$id1." = :".$id1;

   $r = $dbc->prepare($q); 
   $r->execute($val);

   return $dbc->lastInsertId();
   
}
function pdo_deletewh($dbc, $table, $where) {

   $q = "DELETE FROM $table WHERE $where";

   $r = $dbc->prepare($q); 
   $r->execute();

   return $q;
   //$dbc->lastInsertId();
   
}

function pdo_count($dbc, $table, $where) {
   
   if($where == "") {
      $q = "SELECT count(*) FROM $table";
   } else {
      $q = "SELECT count(*) FROM $table WHERE $where";
   }
   $r = $dbc->prepare($q); 
   $r->execute();

   return $r->fetchAll(PDO::FETCH_NUM);
   //return $data;
}