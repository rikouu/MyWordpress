<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'wordpress');

/** MySQL数据库用户名 */
define('DB_USER', 'wordpress');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'wordpress');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Q<8,ZCs`4@!p1Xlrn~4>jzMs4>Q!+/t-xnlJIvZ]D.;=Im@>Fkpm5%@M9dNXvn!)');
define('SECURE_AUTH_KEY',  'u;N!uGE|/5!qPJ-T?-?x,7-mv[U|)XEXVpFxFP5?j8qEJ]lW-<BehLO.:c!t^Pd[');
define('LOGGED_IN_KEY',    'NAKF-Pd^uCv,,<(6(zW+qdcVwh&o/! OMJkl&C4?-go,]<N7)YI-v01! :<&Qmg+');
define('NONCE_KEY',        'EE4n?t8D)(}*6zM+,O-[%`4ef9FFp~RdoMa?PZ,DbX<H5BI50mLR%*QCwhOAtT+p');
define('AUTH_SALT',        ';36ay5<,s(hf%R%}_lmw!0Iz:8fmgdMhVFj*>m/RS@PoVVtnlzuM<M|a=mg^Y1:?');
define('SECURE_AUTH_SALT', 'PhjuK6!)J<p:p5#2oq+|h2XO-`m@`j;_PNw+0x0yf$]sU] ,3AWd{^={}Q+*P-K`');
define('LOGGED_IN_SALT',   'Z--`EogI8)c`oMKP;?^c_?s8$a&yPdiO7KRF3%oN<+vkqm+j/.N9{Ba{|%pz~4<>');
define('NONCE_SALT',       '+T1.=SlI-|AOCA2#X+B)bjV~b$6ICHk@M]k#WS@ZBkB8FSD>|hv7COt&QGL- ?dh');

/**#@-*/

/** change by chew 20150818 解决其他电脑访问网站排版乱序问题 */
define('WP_SITEURL',   'http://192.168.1.100/wordpress');
define('WP_HOME',      'http://192.168.1.100/wordpress');
/** end change by chew 20150818 解决其他电脑访问网站排版乱序问题 */

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'compact_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
