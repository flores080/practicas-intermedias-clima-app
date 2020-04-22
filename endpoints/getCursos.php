<?php
require_once '../lib/header.php';
require_once '../lib/request.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if(empty($_POST))
            $_POST = json_decode(file_get_contents('php://input'), true);

        $cycle = getCicloActivo();
        $block = $_POST['block'];
        $carrera = $_POST['carrera'];
        $blockId = $block['id'];
        $pensumId = $carrera['pensumId'];

        $query = "
            SELECT 
                   cur.curso cursoId,
                   cur.codigo cursoCodigo,
                   cur.nombre cursoNombre,
                   cur.periodos_teoricos cursoPeriodosTeoricos
            
            FROM 
                 SECCION sec 
                     JOIN CURSO cur ON sec.curso = cur.CURSO
                    JOIN CURSO_PENSUM cur_pen on cur.CURSO = cur_pen.CURSO
            
            WHERE 
                  cur.bloque = $blockId AND
                  cur_pen.PENSUM = $pensumId
                  
                 
                  UNION

            SELECT 
                   cur.curso cursoId,
                   cur.codigo cursoCodigo,
                   cur.nombre cursoNombre,
                   cur.periodos_teoricos cursoPeriodosTeoricos
            
            FROM 
                 CURSO cur 
                     JOIN CURSO cur2 ON cur2.curso = cur.partede
                    JOIN CURSO_PENSUM cur_pen on cur.partede = cur_pen.CURSO
            
            WHERE 
                  cur2.bloque = $blockId AND
                  cur_pen.PENSUM = $pensumId
        ";
        $request = new request($query);
        echo $request->response();
        break;
}
