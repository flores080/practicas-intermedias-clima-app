<?php
require_once '../lib/header.php';
require_once '../lib/request.php';

        $query = "
		SELECT * from usuario;
";
        $request = new request($query);
        echo $request->response();