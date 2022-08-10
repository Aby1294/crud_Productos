<?php
function daoGuardarComentario($datos = array()){
    $comentarios = daoObtenerComentarios(); 
    $id = date('Ymdhisu');
    $comentarios[$id] = array(
        'id' => $id,
        'Nombre' => $datos['Nombre'],
        'Email' => $datos['Email'],
        'IdProducto'  => $datos["IdProducto"],
        'Puntuacion' => $datos['Puntuacion'],
        'Comentario' => $datos['Comentario']
    ); 
    $fp = fopen('datos/comentarios.json','w');
    fwrite($fp, json_encode($comentarios));
    fclose($fp);

}

function daoObtenerComentarios(){
    
    if(file_exists('datos/comentarios.json')){ 
        $comentarios = json_decode(file_get_contents('datos/comentarios.json'),TRUE);	
    }else{
        $comentarios = array();
    }
    return $comentarios;

}

function daoObtenerComentario($id){
    $comentarios = daoObtenerComentarios();  
    return $comentarios[$id];

}

function daoModificarComentario($datos = array(), $id){
    $comentarios = daoObtenerComentarios(); 
    $comentarios[$id] = array(
        'id' => $id,
        'Nombre' => $datos['Nombre'],
        'Email' => $datos['Email'],
        'IdProducto'  => $datos['IdProducto'],
        'puntuacion' => $datos['Puntuacion'],
        'Comentario' => $datos['Comentario']
    ); 
    $fp = fopen('datos/comentarios.json','w');
    fwrite($fp, json_encode($comentarios));
    fclose($fp);
}

function daoBorrarComentario($id){
    $comentarios = daoObtenerComentarios(); 
    unset($comentarios[$id]);
    $fp = fopen('datos/comentarios.json','w');
    fwrite($fp, json_encode($comentarios));
    fclose($fp);
}