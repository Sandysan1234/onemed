<?php
// akses.php

function cek_akses($role_required) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role_required) {
        header('Location: 401.php');
        exit;
    }
}

function cek_multi_akses(array $roles_allowed) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles_allowed)) {
        header('Location: 401.php');
        exit;
    }
}
?>