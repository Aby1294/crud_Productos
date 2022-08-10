<?php
include_once('DAO/categoriasDao.php');


function businessGuardarCategoria($datos = array()){
    daoGuardarCategoria($datos);
}

function businessObtenerCategorias(){
    return daoObtenerCategorias();
}

function businessObtenerCategoria($id){
    return daoObtenerCategoria($id);   

}

function businessModificarCategoria($datos = array(), $id){
    daoModificarCategoria($datos, $id);
}

function businessBorrarCategoria($id){
    daoBorrarCategoria($id);
}


?>
