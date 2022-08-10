<?php
function daoGuardarMensaje($datos = array()){
    $mensajes = daoObtenerMensajes(); 
    $id = date('Ymdhisu');
    $mensajes[$id] = array(
        'id' => $id,
        'Nombre' => $datos['Nombre'],
        'Email' => $datos['Email'],
        'Telefono'  => $datos["Telefono"],
        'Reclamo' => $datos['Reclamo'],
        'Comentario' => $datos['Comentario'],
        'Estado' => $datos['Estado'],
        'Respuesta' => $datos['Respuesta'],
        'IdProducto' => $datos['IdProducto']
    ); 
    $fp = fopen('../datos/mensajes.json','w');
    fwrite($fp, json_encode($mensajes));
    fclose($fp);

}

function daoObtenerMensajes(){
    if(file_exists('../datos/mensajes.json')){ 
        $mensajes = json_decode(file_get_contents('../datos/mensajes.json'),TRUE);	
    }else{
        $mensajes = array();
    }
    return $mensajes;
}

function daoObtenerMensaje($id){
    $mensajes = daoObtenerMensajes();  
    return $mensajes[$id];

}

function daoModificarMensaje($datos = array(), $id){
    $mensajes = daoObtenerMensajes(); 
    $mensajes[$id] = array(
        'id' => $id,
        'Nombre' => $datos['Nombre'],
        'Email' => $datos['Email'],
        'Telefono'  => $datos["Telefono"],
        'Reclamo' => $datos['Reclamo'],
        'Comentario' => $datos['Comentario'],
        'Estado' => $datos['Estado'],
        'Respuesta' => $datos['Respuesta'],
        'IdProducto' => $datos['IdProducto']
    ); 
    $fp = fopen('../datos/mensajes.json','w');
    fwrite($fp, json_encode($mensajes));
    sendMail($datos);

    fclose($fp);
}

function daoBorrarMensaje($id){
    $mensajes = daoObtenerMensajes(); 
    unset($mensajes[$id]);
    $fp = fopen('../datos/mensajes.json','w');
    fwrite($fp, json_encode($mensajes));
    fclose($fp);
}

function sendMail($datos){
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 25, 'tls'))
    ->setUsername('mailprueba135@gmail.com')
    ->setPAssword('ijfyvfgpoqcdfzex');

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message($datos['Reclamo']))
        ->setFrom(['gerogome12@gmail.com'])
        ->setTo($datos['Email'])
        ->setBody($datos['Respuesta']);
        //->setContentType("text/html");
	
    return $mailer->send($message);
}

?>