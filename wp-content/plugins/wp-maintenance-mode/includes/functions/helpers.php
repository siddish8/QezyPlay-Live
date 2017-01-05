<?php

/**
 * Get plugin info
 * 
 * @since 2.0.0
 * @param string $plugin_slug
 * @return array
 */
function wpmm_plugin_info($plugin_slug) {
    add_filter('extra_plugin_headers', create_function('', 'return array("GitHub Plugin URI","Twitter");'));
    $plugin_data = get_plugin_data(WPMM_PATH . $plugin_slug . '.php');

    return $plugin_data;
}

/**
 * Count db records using where
 *
 * EDIT: PHP Notice:  wpdb::prepare was called <strong>incorrectly</strong>. The query argument of wpdb::prepare() must have a placeholder.
 * 
 * @since 2.0.0
 * @global object $wpdb
 * @param string $table
 * @param string $field
 * @param array $where eg: array('id_subscriber = %d' => 12)
 */
function wpmm_count_where($table, $field = 'ID', $where = array()) {
    global $wpdb;

    $table = $wpdb->prefix . $table;
    $where_keys = array_keys($where);
    $where_values = array_values($where);

    if (!empty($where)) {
        $query = $wpdb->prepare("SELECT COUNT({$field}) FROM {$table} WHERE " . implode(' AND ', $where_keys), $where_values);
    } else {
        $query = "SELECT COUNT({$field}) FROM {$table}";
    }

    $count = $wpdb->get_var($query);

    return intval($count);
}

/**
 * Outputs the html selected attribute
 *
 * @since 2.0.4
 * @param array $values
 * @param string $current
 * @param bool $echo
 * @return string html attribute or empty string
 */
function wpmm_multiselect($values, $current) {
    foreach ($values as $k => $role) {
        $is_selected = __checked_selected_helper($role, $current, false, 'selected');
        if (!empty($is_selected)) {
            return $is_selected;
            break;
        }
    }
}

/**
 * Return list of banners
 * 
 * @since 2.0.4
 * @return array
 */
function wpmm_get_banners() {
    $banners_path = WPMM_URL . 'assets/images/resources/';

    return array(
        'product' => array(
            array(
                'title' => 'Slides',
                'link' => 'http://designmodo.com/slides/',
                'image' => $banners_path . 'slides.jpg'
            ),
            array(
                'title' => 'Qards',
                'link' => 'http://designmodo.com/qards/',
                'image' => $banners_path . 'qards.jpg'
            )
        ),
        'resource' => array(
            array(
                'title' => 'Free WordPress Theme',
                'link' => 'http://designmodo.com/free-wordpress-theme/',
                'image' => $banners_path . 'ayoshop.jpg'
            ),
            array(
                'title' => 'Linecons',
                'link' => 'http://designmodo.com/linecons-free/',
                'image' => $banners_path . 'linecons.jpg'
            ),
            array(
                'title' => 'Flat UI Free',
                'link' => 'http://designmodo.com/flat-free/',
                'image' => $banners_path . 'flatui.jpg'
            )
        )
    );
}

/**
 * Sanitize Google Analytics SiteID code
 * 
 * Valid examples:
 * UA-..........
 * UA-..........-....
 * 
 * @since 2.0.7
 * @param string $string
 * @return string
 */
function wpmm_sanitize_ga_code($string) {
    preg_match('/UA-\d{4,10}(-\d{1,4})?/', $string, $matches);
   
    return isset($matches[0]) ? $matches[0] : '';
}