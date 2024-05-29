<?php





add_filter('gform_field_value_my-time-field', 'populate_time');
function populate_time($value) {
    return "11";
}