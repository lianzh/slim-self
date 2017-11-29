<?php
define('SELFAPP_PATH', __DIR__);
define('CURRENT_TIMESTAMP', time());

/**
 *	get ClassLoader object
 * 
 * @return \Composer\Autoload\ClassLoader
 */
function classLoader()
{
	static $loader = null;
	if ( is_null($loader) )
	{
		$loader = new \Composer\Autoload\ClassLoader();
		$loader->register();
	}

	return $loader;
}

/**
 * Generate URL with paging parameters
 *
 * @param  string $url
 * @param  int $page
 * @return string
 */
function paging_url($url, $page)
{
    $pars = parse_url($url);
    if (!empty($pars)) {
        parse_str($pars['query'], $query);
        if (!is_array($query)) {
            $query = array();
        }
        $query['page'] = $page;
        $pars['query'] = http_build_query($query);

        $url = "{$pars['scheme']}://{$pars['host']}{$pars['path']}?{$pars['query']}";
        if ( !empty($pars['port']) && (80 != $pars['port']) )
        {
            $url = "{$pars['scheme']}://{$pars['host']}:{$pars['port']}{$pars['path']}?{$pars['query']}";
        }

        if (!empty($pars['fragment'])) {
            $url .= "#{$pars['fragment']}";
        }

        return $url;
    }
    return 'javascript:;';
}

function identify36($x)
{
    static $mask = '0123456789abcdefghijklmnopqrstuvwxyz';
    $x = sprintf("%u", crc32($x));

    $m = '';
    while ($x > 0) {
        $s = $x % 36;
        $m .= $mask[$s];
        $x = floor($x / 36);
    }
    return $m;
}

/**
 * 转换 HTML 特殊字符，等同于 htmlspecialchars()
 *
 * @param string $text
 *
 * @return string
 */
function h($text)
{
    return htmlspecialchars($text);
}

/**
 * 输出转义后的字符串
 *
 * @param string $text
 */
function p($text)
{
    echo htmlspecialchars($text);
}

function t($text)
{
    return nl2br(str_replace(' ', '&nbsp;', htmlspecialchars($text)));
}

function t2js($content)
{
    return str_replace(array("\r", "\n"), array('', '\n'), addslashes($content));
}

/**
 * fast_uuid 为模型生成 64 位整数或混淆字符串的不重复 ID
 * 
 * 参数 suffix_len指定 生成的 ID 值附加多少位随机数，默认值为 3
 * 
 * @param int suffix_len
 * 
 * @return string
 */
function fast_uuid($suffix_len=3){
    //! 计算种子数的开始时间
    static $being_timestamp = 1336681180;// 2012-5-10
        
    $time = explode(' ', microtime());
    $id = ($time[1] - $being_timestamp) . sprintf('%06u', substr($time[0], 2, 6));
    if ($suffix_len > 0)
    {
        $id .= substr(sprintf('%010u', mt_rand()), 0, $suffix_len);
    }
    return $id;
}

/**
 * SelfApp\Helper\Debug::dump() 的简写，用于输出一个变量的内容
 *
 * @param mixed $vars 要输出的变量
 * @param string $label 输出变量时显示的标签
 * @param int $depth
 * @param bool $return
 *
 * @return string
 */
function dump($vars, $label = null, $depth = null, $return = false)
{
    if ($return) ob_start();
    \SelfApp\Helper\Debug::dump($vars, $label, $depth);
    if ($return) return ob_get_clean();
}

/**
 * print_r 函数的美化，用于输出一个变量的内容
 *
 * @param mixed $vars 要输出的变量
 * @param string $label 输出变量时显示的标签
 * @param bool $return
 *
 * @return string
 */
function prety_printr($vars, $label = '', $return = false)
{
    $content = "<pre>\n";
    if ($label != '') {
        $content .= "<strong>{$label} :</strong>\n";
    }
    $content .= htmlspecialchars(print_r($vars, true),ENT_COMPAT | ENT_IGNORE);
    $content .= "\n</pre>\n";

    if ($return) { return $content; }
    echo $content;
}

/**
 * safe_file_put_contents() 一次性完成打开文件，写入内容，关闭文件三项工作，并且确保写入时不会造成并发冲突
 *
 * @param string $filename
 * @param string $content
 *
 * @return boolean
 */
function safe_file_put_contents($filename, & $content)
{
    $fp = fopen($filename, 'w');
    if (!$fp) { return false; }
    if (!flock($fp, LOCK_EX)) {
        fclose($fp);
        return false;
    }
    fwrite($fp, $content);
    fclose($fp);
    return true;
}

/**
 * 遍历指定目录及子目录下的文件，返回所有与匹配模式符合的文件名
 *
 * @param string $dir
 * @param string $pattern
 *
 * @return array
 */
function recursion_glob($dir, $pattern)
{
    $dir = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR;
    $files = [];

    $dh = opendir($dir);
    if (!$dh) return $files;

    $items = (array)glob($dir . $pattern);
    foreach ($items as $item)
    {
        if (is_file($item)) $files[] = $item;
    }

    while (($file = readdir($dh)))
    {
        if ($file == '.' || $file == '..') continue;

        $path = $dir . $file;
        if (is_dir($path))
        {
            $files = array_merge($files, recursion_glob($path, $pattern));
        }
    }
    closedir($dh);
    return $files;
}