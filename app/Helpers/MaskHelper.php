<?php

if (!function_exists('maskEmail')) {
    function maskEmail($email) {
        if (empty($email) || !str_contains($email, '@')) {
            return $email; // Return as-is if invalid
        }

        $parts = explode('@', $email);
        $local = $parts[0];
        $domain = $parts[1] ?? '';
        $length = strlen($local);

        if ($length <= 3) {
            // Avoid negative repeat count
            $masked = substr($local, 0, 1) . str_repeat('*', max($length - 1, 0));
        } else {
            // Show first 3 letters, mask the rest except last letter
            $masked = substr($local, 0, 3) . str_repeat('*', max($length - 4, 0)) . substr($local, -1);
        }

        return $masked . '@' . $domain;
    }
}