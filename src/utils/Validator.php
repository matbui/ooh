<?php
class Validator {
    public static function validatePasswords($password, $confirm_password) {
        return $password === $confirm_password;
    }
}
?>
