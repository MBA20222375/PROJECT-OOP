<?php


use Oop\Project\details;
use Oop\Project\User;

class AccountDetailsController
{
    public static function handle($pdo)
    {
        if (($_SERVER['REQUEST_METHOD'] !== 'POST') || (!isset($_SESSION['user_id']))) {
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
        $fName = trim($_POST['first-name']);
        $lName = trim($_POST['last-name']);
        $name = $fName . " " . $lName;
        $email = trim($_POST['email']);

        $userId = $_SESSION['user_id'];

        if ($name === '' || $email === '') {
            set_messages([['content' => 'الاسم والإيميل مطلوبين', 'type' => 'danger']]);

            header("Location: index.php?page=account_details");
            die();
        }

        details::updateInfo($pdo, $userId, $name, $email);

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;

        set_messages([['content' => 'تم تحديث البيانات بنجاح', 'type' => 'success']]);

        header("Location: index.php?page=account_details");
        die();
    }

    private static function changePassword($pdo)
    {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($new === '' || $new !== $confirm) {
            set_messages([['content' => 'كلمة المرور غير متطابقة', 'type' => 'danger']]);

            header("Location: index.php?page=account_details");
            die();
        }

        $user = User::getUserById($pdo, $_SESSION['user_id']);

        if (!password_verify($current, $user->getPassword())) {
            set_messages([['content' => 'كلمة المرور الحالية غير صحيحة', 'type' => 'danger']]);

            header("Location: index.php?page=account_details");
            die();
        }

        $hashed = password_hash($new, PASSWORD_DEFAULT);

        details::updatePassword($pdo, $_SESSION['user_id'], $hashed);

        set_messages([['content' => 'تم تغيير كلمة المرور بنجاح', 'type' => 'success']]);

        header("Location: index.php?page=account_details");
        die();
    }
}

AccountDetailsController::handle($db);
