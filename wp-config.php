<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

 if (file_exists(dirname(__FILE__) . '/wp-config-local.php')) {
    include(dirname(__FILE__) . '/wp-config-local.php');
} else {
    include(dirname(__FILE__) . '/wp-config-prod.php');
}

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$&^+mb|pNA| ru^.tq@FJk8O<j}l{~[Qc;ClHdWN9O!VQJRp+e|p>gr[L;L&AW,c');
define('SECURE_AUTH_KEY',  'R,5D-dYUzW?|smKI0sAh3>4[LvPeuxi8VJM- g/j,|MOO;lWXa[V55ThI:9Qq|;E');
define('LOGGED_IN_KEY',    'S;xIfG&UC-/i{h+_}Zg(a5@~cf3)0A-UN{a7O0Q*].J6!=f:S_#Q0Iw1QSSt-z++');
define('NONCE_KEY',        '](^vUT?[N+Su5iIm,jeOYY?2Jk9|4 #C= {x~_<%)xU~J0?%|0~ijuruN#nb2jW{');
define('AUTH_SALT',        'o*[3r?cibEXPp5v2T~nmjib{#-P/zpd+Cl-&p7 -zZ.bsxCR2dZNJXkh1&h`Q-iy');
define('SECURE_AUTH_SALT', 'g*?VkLiEMt]%zXfOg[_,j,2iCa@nAD>-knehvcus]<5w|]V+:8)<w e+zeWn)i<l');
define('LOGGED_IN_SALT',   '|d(-Cm:+DJb^&YtV|z:.cw];b+pIr|+b7:{anPf`tM7Pzl#YX|;HdURz:ze}Oht;');
define('NONCE_SALT',       '!-f^m~IrnHGdHlb6x}LmgXK*BIY++=XvWz[qHG7}mlH*>G@Vk6UE%{G1o|o8f{V&');

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
