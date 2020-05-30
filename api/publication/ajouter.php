<?php

require_once '../../src/includes-api.php';

use Publication\Publication;
use Sanitize\Sanitize;

header('Content-Type: application/json; charset=UTF-8');

// Check if params are sended
if (Sanitize::checkEmptyFields($_POST, ['description', 'groupe']) && Sanitize::checkEmptyFields($_FILES, ['photo'])) {

    $secured = Sanitize::arrayFields($_POST, ['description', 'groupe']);
    $file = $_FILES['photo'];

// --------------- PROCESSING THE REQUEST------------------------

    $publication = new publication($db);

    if ($publication->set($secured['description'], )) {

        http_response_code(200);
        echo json_encode([

            'id' => $publication->id,
            'date' => $publication->date,
            'description' => $publication->description,
            'photoURL' => NULL,
            'utilisateur' => [
                'photoURL' => '',
                'nom' => $_SESSION['user']->name . ' ' . $_SESSION['user']->surname,
            ]
        ]);

    } else {
        http_response_code(500);
        echo json_encode('Server Error');
    }

// --------------- END - PROCESSING THE REQUEST------------------------

} else {
    http_response_code(400);
    echo json_encode('Missing Arguments');
}