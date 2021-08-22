<?php
use Firebase\JWT\JWT;
function jwt_encode($payload){
    return JWT::encode($payload, JWT_KEY);
}
function jwt_decode($jwt){
    return JWT::decode($jwt, JWT_KEY, array('HS256'));
}