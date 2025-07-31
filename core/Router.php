<?php
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/profile', [AuthController::class, 'requireAuth']);
$router->get('/profile', [ProfileController::class, 'index']);
$router->post('/profile', [ProfileController::class, 'index']);
$router->get('/profile', 'AuthController@profile');
$router->post('/profile', 'AuthController@profile'); // pour gérer les POST (upload photo, changement mdp)
$router->add('GET|POST', '/edit-username', [UserController::class, 'editUsername']);
