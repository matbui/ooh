<?php
require_once 'src/utils/Validator.php';

class SignupController {
    public static function handleSignup() {
        header('Content-Type: application/json'); 

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $terms = isset($_POST['terms']);

        if (!Validator::validatePasswords($password, $confirm_password)) {
            echo json_encode(['status' => 'error', 'message' => 'Las contraseñas no coinciden.']);
            exit;
        }

        if (!$terms) {
            echo json_encode(['status' => 'error', 'message' => 'Debe aceptar los términos y condiciones.']);
            exit;
        }

        $user_data = array(
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );

        $file_path = 'src/data/users.json';
        if (!file_exists($file_path)) {
            file_put_contents($file_path, json_encode([$user_data]));
        } else {
            $current_data = json_decode(file_get_contents($file_path), true);
            array_push($current_data, $user_data);
            file_put_contents($file_path, json_encode($current_data));
        }

        echo json_encode(['status' => 'success', 'message' => 'Usuario registrado correctamente.']);
    }
}
?>
