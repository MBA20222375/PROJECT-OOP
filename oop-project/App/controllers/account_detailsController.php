<?php


use Oop\Project\details;

class AccountController
{
    public static function handle($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        if (isset($_POST['update_account'])) {
            self::updateAccount($pdo);
        }

        if (isset($_POST['change_password'])) {
            self::changePassword($pdo);
        }
    }

    private static function updateAccount($pdo)
    {
        $name  = trim($_POST['name']);
        $email = trim($_POST['email']);
        $userId = $_SESSION['user']['id'];

        if ($name === '' || $email === '') {
            $_SESSION['error'] = 'الاسم والإيميل مطلوبين';
            return;
        }

        details::updateInfo($pdo, $userId, $name, $email);

        $_SESSION['user']['name']  = $name;
        $_SESSION['user']['email'] = $email;

        $_SESSION['success'] = 'تم تحديث البيانات بنجاح';
    }

    private static function changePassword($pdo)
    {
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($new === '' || $new !== $confirm) {
            $_SESSION['error'] = 'كلمة المرور غير متطابقة';
            return;
        }

        if (!password_verify($current, $_SESSION['user']['password'])) {
            $_SESSION['error'] = 'كلمة المرور الحالية غير صحيحة';
            return;
        }

        $hashed = password_hash($new, PASSWORD_DEFAULT);

        details::updatePassword($pdo, $_SESSION['user']['id'], $hashed);

        $_SESSION['success'] = 'تم تغيير كلمة المرور بنجاح';
    }
}
