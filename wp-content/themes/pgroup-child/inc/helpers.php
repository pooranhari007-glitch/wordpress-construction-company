<?php
/**
 * Small reusable template helpers.
 *
 * @package PGroupChild
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns ACF value when available, else fallback.
 *
 * @param string $key Field name.
 * @param mixed  $fallback Fallback value.
 *
 * @return mixed
 */
function pgroup_get_field_safe($key, $fallback = '')
{
    if (function_exists('get_field')) {
        $value = get_field($key);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }

    return $fallback;
}
