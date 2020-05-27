<?php

require_once '../../includes.php';

use Commentaire\Commentaire;
use Sanitize\Sanitize;

header('Content-Type: application/json; charset=UTF-8');

// Check if params are sended
if (Sanitize::checkEmptyFields($_GET, ['id_ut'], ['id'])) {

$secured = Sanitize::arrayFields($_GET, ['id_ut'], ['id']);

// --------------- PROCESSING THE REQUEST------------------------

$commentaire = new Commentaire($db);
$commentaire->id = $secured['id'];

if ($commentaire->delete($secured['id'], $secured['id_ut'])) {//action a faire

http_response_code(200);//envoie reponse
echo json_encode(
[
'id' => $commentaire->id
]
);

} else {
http_response_code(500);
echo json_encode('Server Error');
}

// --------------- END - PROCESSING THE REQUEST------------------------

} else {

http_response_code(400);
echo json_encode('Missing Arguments');

/* http_response_code(401);
echo json_encode('Please login to use our services'); */

}