<?php
include_once('DAO/productosDao.php');
include_once('../helpers/image.php');


function businessGuardarProducto($datos = array(),$archivo = array()){

    /*if(!empty($_FILES['imagen'])){
        $datos['imagen'] = $_FILES['imagen']['name'];
    }*/
    $id = daoGuardarProducto($datos,$_FILES);
    
    if(!empty($_FILES['imagen'])){
        saveImage($_FILES['imagen'], $id);
    } 


}

function businessObtenerProductos(){
    return daoObtenerProductos();
}

function businessObtenerProducto($id){
    return daoObtenerProducto($id);
}

function businessModificarProducto($datos = array(), $id,$archivo = array()){

    if(!empty($_FILES['imagen'])){
        $datos['imagen'] = $_FILES['imagen']['name'];
    }
    daoModificarProducto($datos,$id,$_FILES);
    

    if(!empty($_FILES['imagen'])){
        saveImage($_FILES['imagen'], $id);
    }

//die();   
}

function saveImage($datos,$id){
    
    $ruta= '../img/product-details/';
    if(!is_dir($ruta)){
        mkdir($ruta,0777,true);
    }
    $tamanhos = array(0 => array('nombre'=>'small','ancho'=>'1200','alto'=>'1200'));
    
    redimensionar ($ruta,$datos['name'],$datos['tmp_name'],0,$tamanhos);
}

function businessBorrarProducto($id){
    daoBorrarProducto($id);
     
}

?>