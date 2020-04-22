<?php

include('Cipher.php');

// Simple router
switch ($_SERVER['REQUEST_URI'] . ' ' . $_SERVER['REQUEST_METHOD']) {
	case '/ GET':
		echo '<h1>Main Page</h1>';
		break;
	case '/api/encode POST':
		Cipher::encode();
		break;
	default:
		http_response_code(404);
		echo '<h1>Not Found</h1>';
}

