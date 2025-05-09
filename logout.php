<?php
include "function.php";

$user_id = $_SESSION['user_id'] ?? null;


if ($user_id) {
    mysqli_query($koneksi, "
        UPDATE tb_users_log 
        SET logout_time = NOW() 
        WHERE user_id = $user_id 
        AND logout_time IS NULL 
        ORDER BY login_time DESC 
        LIMIT 1
    ");
}
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>