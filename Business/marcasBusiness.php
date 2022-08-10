<?php
include_once('DAO/marcasDao.php');

 

function businessGuardarMarca($datos = array()){
    daoGuardarMarca($datos);
}

function businessObtenerMarcas(){
    return daoObtenerMarcas();
}

function businessObtenerMarca($id){
    return daoObtenerMarca($id);   

}

function businessModificarMarca($datos = array(), $id){
    daoModificarMarca($datos, $id);
}

function businessBorrarMarca($id){
    daoBorrarMarca($id);
}



?>
