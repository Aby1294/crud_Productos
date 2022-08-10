<?php
 

function daoObtenerCategorias(){
    if(file_exists('../datos/categoria.json')){ 
        $cats = json_decode(file_get_contents('../datos/categoria.json'),TRUE);	
    }else{
        $cats = array();
    }
    return $cats;
}

function daoGuardarCategoria($datos = array()){
    $categoria = daoObtenerCategorias(); 
    $id = date('Ymdhisu');
    $categoria[$id] = array(
        'Id' => $id,
        'nombre' => $datos['nombre']
    ); 
    $fp = fopen('../datos/categoria.json','w');
    fwrite($fp, json_encode($categoria));
    fclose($fp);
}

function daoObtenerCategoria($id){
    $categoria = daoObtenerCategorias();  
    return $categoria[$id];

}

function daoModificarCategoria($datos = array(), $Id){
    $categoria = daoObtenerCategorias(); 
    $categoria[$Id] = array(
        'Id' => $Id,
        'nombre' => $datos['nombre']
    ); 
    $fp = fopen('../datos/categoria.json','w');
    fwrite($fp, json_encode($categoria));
    fclose($fp);
}

function daoBorrarCategoria($id){
    $categoria = daoObtenerCategorias(); 
    unset($categoria[$id]);
    $fp = fopen('../datos/categoria.json','w');
    fwrite($fp, json_encode($categoria));
    fclose($fp);
}

?>
 