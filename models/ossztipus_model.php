<?php

class Ossztipus_Model {
    public function get_data($vars): array {
        $retData['eredmeny'] = array();
        try {
            $dbh = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            $stmt = $dbh->prepare(
                "SELECT sutik.tipus tipus, COUNT(sutik.id) 'darab' FROM sutik
GROUP BY tipus ORDER BY tipus"
            );
            $stmt->execute();
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $item) {
                $retData['uzenet']['tipus'][] = $item['tipus'];
                $retData['uzenet']['darab'][] = $item['darab'];
            }
        } catch
        (PDOException $e) {
            $retData['eredmeny'] = "ERROR";
            $retData['uzenet'] = $e->getMessage();
        }
        return $retData;
    }
}