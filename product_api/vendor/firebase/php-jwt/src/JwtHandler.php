<?php
require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler {
    private $secret_key = "YOUR_SECRET_KEY";

    public function encode($payload) {
        return JWT::encode($payload, $this->secret_key, 'HS256');
    }

    public function decode($token) {
        return JWT::decode($token, new Key($this->secret_key, 'HS256'));
    }
}
?>