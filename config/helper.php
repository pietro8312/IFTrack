<?php
    function load_static($file){
        $file = ltrim($file, '/');
        return '/IFTrack/static/' . $file;
    }
?>