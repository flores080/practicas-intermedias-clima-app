<?php
require_once '../lib/header.php';
require_once '../lib/request.php';

$m = isset($_GET['p']);
$u = $_GET['u'];
//$user = $_GET['usr'];
$query = "
                select usuarioce from usuariointerno
                where id = '$u'";

$request = new request($query);
$user = $request->arrayResponse()[0]['usuarioce'];

$menuPadre = 'menuPadre '. ($m ? '= '.$_GET['p'] : 'is null');


$query = "
                select * from ruta_menu_interno rmi
                inner join ruta_menu_acceso rma on rmi.menu = rma.ruta_menu_interno
                where $menuPadre and rma.usuariointerno = $user and rma.status = 0
                order by rmi.orden
        ";

$request = new request($query);
$menus = $request->arrayResponse();
for($i = 0; $i<sizeof($menus); $i++){
    $menus[$i]['submenus'] = GetChildMenus($menus[$i], $m, $user);
}
echo json_encode($menus);


function GetChildMenus($menu, $m, $user){
    if(!$m) return [];

    $men = $menu['menu'];

    $query = "
                select * from ruta_menu_interno rmi
                inner join ruta_menu_acceso rma on rmi.menu = rma.ruta_menu_interno
                where menuPadre = $men and rma.usuariointerno = $user and rma.status = 0
                order by rmi.orden
        ";
    $request = new request($query);
    $menus = $request->arrayResponse();
    for($i = 0; $i<sizeof($menus); $i++){
        $menus[$i]['submenus'] = GetChildMenus($menus[$i], $menus[$i]['menu'], $user);
    }
    return $menus;
}