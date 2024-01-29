<?php

class Hirek_Model
{
    public function index()
    {
        $retData['eredmeny'] = "";
        try {
            $connection = Database::getConnection();
            $sql = "select h.id, h.cim, h.bevezeto, h.ido, f.bejelentkezes "
                . "from hir h "
                . "left join felhasznalok f on h.felhasznalo_id = f.id "
                . "order by h.ido desc";
            $stmt = $connection->query($sql);
            $hirek = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['hirek'] = $hirek;
        } catch (PDOException $e) {
            $retData['eredmény'] = "ERROR";
            $retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
        }
        return $retData;
    }

    public function mutat($id)
    { $connection = Database::getConnection();
        $sql = "select h.id, h.cim, h.torzs, h.ido,h.felhasznalo_id, f.bejelentkezes "
            . "from hir h "
            . "left join felhasznalok f on h.felhasznalo_id = f.id "
            . "where h.id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute(array($id));
        $hir = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($hir) {
            $retData['hir'] = $hir;

            $sql = "select v.id, v.torzs, v.ido, f.bejelentkezes "
                . "from velemeny v "
                . "left join felhasznalok f on v.felhasznalo_id = f.id "
                . "where v.hir_id = ? "
                . "order by v.ido asc";
            $stmt = $connection->prepare($sql);
            $stmt->execute(array($id));
            $velemenyek = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($velemenyek) {
                $retData['velemenyek'] = $velemenyek;
            } else {
                $retData['velemenyek'] = array();
            }
        } else {
            $retData['hir'] = array();
            $retData['velemenyek'] = array();
        }

        return $retData;
    }

    public function hozzaszolasMentes($hirId, $felhasznaloId, $szoveg)
    {
        $connection = Database::getConnection();
        $sql = "INSERT INTO velemeny (hir_id, felhasznalo_id, torzs, ido) VALUES (?, ?, ?, NOW())";
        $stmt = $connection->prepare($sql);

        if ($stmt->execute(array($hirId, $felhasznaloId, $szoveg))) {

            return true;
        } else {
            return false;
        }
    }



}


?>