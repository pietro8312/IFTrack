<?php
    function load_static($file){
        $file = ltrim($file, '/');
        return '/IFTrack/static/' . $file;
    }

    function includeWithMessage($file, $message) {
        // Torna a variável acessível dentro do arquivo incluído
        $msg = $message;

        // Inicia o buffer para capturar o output
        ob_start();
        include $file; // executa o arquivo
        return ob_get_clean(); // retorna o conteúdo como string
    }
?>