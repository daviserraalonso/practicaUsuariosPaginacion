<?php
     
     
    require '../classes/autoload.php';

    use izv\data\Usuario;
    use izv\database\Database;
    use izv\managedata\ManagerUsuario;
    use izv\tools\Reader;
    use izv\tools\Alert;
    use izv\tools\Util;
    use izv\sessions\Session;
    use izv\app\App;
    
    
    /*
    $url = 'https://dwse-scorpions.c9users.io/practicaUsuariosMVCPaginacion';
    $sesion = new Session(App::SESSION_NAME);
    if(!$sesion->isLogged()) {
        exit();
        header('Location: ' . $url);
    }
    */
        $correo = Reader::read('correo');
        $clave = Reader::read('clave');
        
        $db = new Database();
        $manager = new ManagerUsuario($db);
        
        $result = $manager->login($correo, $clave);
        
        $resultado = 0;
        
        $sesion = new Session(App::SESSION_NAME);
        
        $claveEncriptada = Util::encriptar($clave);
            
        if(correcto == true) {
            $sesion->login($result);
            $resultado = 1;
            $url = Util::url() . '../panel/indexPanel.php?op=login&resultado=' . $resultado;
            header('Location: ' . $url);
        } else {
            $url = Util::url() . 'https://dwse-scorpions.c9users.io/practicaUsuariosMVCPaginacion?op=login&resultado=' . $resultado;
            header('Location: ' . $url);
        }
    