<?php

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login()
    {
        CsrfMiddleware::check();

        $input = Security::requestInput();

        $email = Security::cleanEmail($input['email'] ?? '');
        $password = (string) ($input['password'] ?? '');

        if (empty($email) || empty($password)) {
            Response::json([
                'success' => false,
                'message' => 'Vui lòng nhập email và mật khẩu'
            ], 400);
        }

        if (!Security::isValidEmail($email)) {
            Response::json([
                'success' => false,
                'message' => 'Email không hợp lệ'
            ], 422);
        }

        try {
            $user = $this->userModel->findByEmail($email);
        } catch (PDOException $error) {
            Response::json([
                'success' => false,
                'message' => 'Loi ket noi database. Kiem tra DB_HOST, DB_NAME, DB_USER, DB_PASS trong file .env hoac GitHub Secrets.'
            ], 500);
        }

        if (!$user || !password_verify($password, $user['password'])) {
            Response::json([
                'success' => false,
                'message' => 'Email hoặc mật khẩu không đúng'
            ], 401);
        }

        $token = JwtService::createToken([
            'user_id' => $user['id'],
            'email' => $user['email']
        ]);

        try {
            $this->userModel->logActivity((int) $user['id'], 'login', 'Dang nhap vao dashboard');
        } catch (PDOException $error) {
            Response::json([
                'success' => false,
                'message' => 'Dang nhap dung nhung khong ghi duoc log hoat dong. Kiem tra bang user_activities trong database.'
            ], 500);
        }

        Response::json([
            'success' => true,
            'message' => 'Đăng nhập thành công',
            'token' => $token,
            'user' => [
                'id' => $user['id'],
                'name' => Security::cleanString($user['name']),
                'email' => Security::cleanEmail($user['email'])
            ]
        ]);
    }
}
