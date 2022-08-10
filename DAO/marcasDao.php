<?php
 

function daoObtenerMarcas(){
    if(file_exists('../datos/marcas.json')){ 
        $data = json_decode(file_get_contents('../datos/marcas.json'),TRUE);	
    }else{
        $data = array();
    }
    return $data;
}

function daoGuardarmarca($datos = array()){
    $marca = daoObtenerMarcas(); 
    $id = date('Ymdhisu');
    $marca[$id] = array(
        'Id' => $id,
        'nombre' => $datos['nombre']
    ); 
    $fp = fopen('../datos/marcas.json','w');
    fwrite($fp, json_encode($marca));
    fclose($fp);
}

function daoObtenerMarca($id){
    $marca = daoObtenerMarcas();  
    return $marca[$id];

}

function daoModificarMarca($datos = array(), $Id){
    $marca = daoObtenerMarcas(); 
    $marca[$Id] = array(
        'Id' => $Id,
        'nombre' => $datos['nombre']
    ); 
    $fp = fopen('../datos/marcas.json','w');
    fwrite($fp, json_encode($marca));
    fclose($fp);
}

function daoBorrarMarca($id){
    $marca = daoObtenerMarcas(); 
    unset($marca[$id]);
    $fp = fopen('../datos/marcas.json','w');
    fwrite($fp, json_encode($marca));
    fclose($fp);
}

?>
 