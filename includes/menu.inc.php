<?php

Class Menu {
    public static $menu = array();
    
    public static function setMenu() {
        self::$menu = array();
        $connection = Database::getConnection();
        $stmt = $connection->query("select url, nev, szulo, jogosultsag from menu where jogosultsag like '".$_SESSION['userlevel']."'order by sorrend");
        while($menuitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$menu[$menuitem['url']] = array($menuitem['nev'], $menuitem['szulo'], $menuitem['jogosultsag']);
        }
    }

    public static function getMenu($sItems) {
        $submenu = "";

        $menu = "<ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>";
        foreach(self::$menu as $menuindex => $menuitem)
        {
            if($menuitem[1] == "")
            { $menu.= "<li class='nav-item'><a href='".SITE_ROOT.$menuindex."' class='nav-link active'>".$menuitem[0]."</a></li>"; }
           }
        $menu.="</ul>";

        if($submenu != "")
            $submenu = "<ul>".$submenu."</ul>";

        return $menu.$submenu;
    }

    public static $cookies = array();
    public static $cookiescategory = array();

    public static $cookiecontent = array();

    public static function setCookies() {
        self::$cookies = array();
        $connection = Database::getConnection();
        $stmt = $connection->query("select id, nev, tipus, dijazott from sutik");
        while($cookieitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$cookies[$cookieitem['id']] = array($cookieitem['nev'], $cookieitem['tipus'],$cookieitem['id'], $cookieitem['dijazott']);
        }
    }

    public static function setCookiescategory() {
        self::$cookiescategory = array();
        $connection = Database::getConnection();
        $stmt = $connection->query("select id, sutiid, ertek, egyseg from sutiar");
        while($cookiecatitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$cookiescategory[$cookiecatitem['id']] = array($cookiecatitem['sutiid'], $cookiecatitem['ertek'], $cookiecatitem['egyseg']);
        }
    }

    public static function setCookiescontent() {
        self::$cookiecontent = array();
        $connection = Database::getConnection();
        $stmt = $connection->query("select id, sutiid, mentes from tartalom");
        while($cookiecontitem = $stmt->fetch(PDO::FETCH_ASSOC)) {
            self::$cookiecontent[$cookiecontitem['id']] = array($cookiecontitem['sutiid'], $cookiecontitem['mentes']);
        }
    }

    public static function getCookies() {
        $submenu = "";

        $menu = "";
        foreach(self::$cookies as $menuindex => $cookieitem)
        {
            $sutiid = $cookieitem[2];
            $sutiar = 0;
            $sutiegyseg = '';
            $sutitartalom = '';
            foreach(self::$cookiescategory as $cookieindex => $cookiecat)
            {
                if ($sutiid == $cookiecat[0]){
                    $sutiar = $cookiecat[1];
                    $sutiegyseg = $cookiecat[2];
                }
            }
            foreach(self::$cookiecontent as $cookiecontentindex => $cookiecont)
            {
                if ($sutiid == $cookiecont[0]){
                    $sutitartalom = $cookiecont[1];
                    $menu.= "<div class='col mb-5'><div class='card h-100'><img class='card-img-top' src='https://www.seriouseats.com/thmb/5gQaEB-9ZucRv1Gw8QYYSVanHzo=/450x300/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__recipes__images__2017__08__20170727-bravetart-chocolate-chip-cookies-vicky-wasik-13-fe97275bb3cc4fde86c4dffb141d0b69.jpg' alt='pizza1' /><div class='card-body p-4'><div class='text-center'><h5 class='fw-bolder'>$cookieitem[0]</h5>Kategória: $cookieitem[1]</div><div class='text-center'><h5></h5>$sutiar Ft / $sutiegyseg</div><div class='text-center'><h5></h5>$sutitartalom mentes</div></div><div class='card-footer p-4 pt-0 border-top-0 bg-transparent'></div></div></div>";
                }

            }
            $menu.= "<div class='col mb-5'><div class='card h-100'><img class='card-img-top' src='https://www.seriouseats.com/thmb/5gQaEB-9ZucRv1Gw8QYYSVanHzo=/450x300/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__recipes__images__2017__08__20170727-bravetart-chocolate-chip-cookies-vicky-wasik-13-fe97275bb3cc4fde86c4dffb141d0b69.jpg' alt='pizza1' /><div class='card-body p-4'><div class='text-center'><h5 class='fw-bolder'>$cookieitem[0]</h5>Kategória: $cookieitem[1]</div><div class='text-center'><h5></h5>$sutiar Ft / $sutiegyseg</div></div><div class='card-footer p-4 pt-0 border-top-0 bg-transparent'></div></div></div>";
        }
        $menu.="";

        if($submenu != "")
            $submenu = "".$submenu."";

        return $menu.$submenu;
    }

}
Menu::setCookies();
Menu::setCookiescontent();
Menu::setCookiescategory();
Menu::setMenu();
?>
