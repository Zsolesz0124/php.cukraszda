<?php

class regisztral_model
{
    public function get_data($vars)
    {
        $retData['eredmeny'] = "";
        try {
            $connection = Database::getConnection();
            $sql = "select id, csaladi_nev, utonev, jogosultsag from felhasznalok where bejelentkezes='".$vars['bejelentkezes']."' ";
            $stmt = $connection->query($sql);
            $felhasznalo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            switch(count($felhasznalo)) {
                case 0:
                    $retData['eredmeny'] = "ERROR";
                    $retData['uzenet'] = "Regisztráció sikeres! Kérem jelentkezzen be az új felhasználónévvel! " . $vars['bejelentkezes'] ;
                    $sqlInsert = "insert into felhasznalok(id, csaladi_nev, utonev, bejelentkezes, jelszo, jogosultsag) values (0, :csaladinev, :utonev, :bejelentkezes, :jelszo, :jogosultsag  ) ";
                    $stmt = $connection->prepare($sqlInsert);
                    $stmt->execute(array(':csaladinev' => $vars['csaladi_nev'], ':utonev' => $vars['utonev'],
                        ':bejelentkezes' => $vars['bejelentkezes'],':jogosultsag' => "_1_" ,':jelszo' => sha1($vars['jelszo'])));
                    break;

                default:
                    $retData['eredmeny'] = "ERROR";
                    $retData['uzenet'] = "Ezzel a felhasználónévvel már regisztráltak!";
            }
        }
        catch (PDOException $e) {
            $retData['eredmeny'] = "ERROR" ;
            $retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
        }
        return $retData;
    }
}