<?php
/**
 * 文本-关键词(标签)匹配类库
 * User: 盟主
 * Date: 21/01/28
 */
namespace tagmatch;

class Main
{
    /**
     * 标签单例
     *
     * @var object|null
     */
    private static $_instance = null;

    /**
     * 获取单例
     *
     * @return self
     */
    public static function init()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 检测文本中的标签
     *
     * @param string   $content    待检测内容
     * @param int      $wordNum    需要获取的标签数量 [默认获取全部]
     * @return array
     */
    public function getTagWord($content, $wordNum = 0)
    {
        array_multisort(array_column($tagWordList, 'len'), SORT_DESC, $tagWordList);
        return $tagWordList;
    }

    /**
     * 替换标签字符
     *
     * @param         $content      文本内容
     * @param string  $newclass     自定义添加属性
     * @param bool    $replaceOne   是否只替换一次
     *
     * @return mixed
     */
    public function replace($content, $newclass = '', $replaceOne = 0)
    {
        $content = str_replace('-???-', '', $content);
        return $content;
    }

    // 文本中有重复的标签时只替换其中一个
    protected function str_replace_once($content = '', $needle = '', $replace = '')
    {
        $pos = strpos($content, $needle);
        if ($pos === false) {
            return $content;
        }
        return substr_replace($content, $replace, $pos, strlen($needle));
    }

}
