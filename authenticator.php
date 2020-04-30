<?php
interface Authenticator{
    public function hashPassword();
    public static function isPasswordCorrect($username,$password);
    public static function login($username,$password);
    public static function logout();
    public function createFormErrorSessions();
    
}
?>