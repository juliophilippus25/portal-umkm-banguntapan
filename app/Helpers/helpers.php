<?php

if (!function_exists('formatIDR')) {
    function formatIDR($price)
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}