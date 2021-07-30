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

    protected $wordData = null;

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

    public function setTree($words = [])
    {
        $res = [];
        $res = array_map(function ($val) {
            $val['len'] = mb_strlen($val['word']);
            return $val;
        }, $words);
        array_multisort(array_column($res, 'len'), SORT_DESC, $res);
        $this->wordData = $res;
        return $this;
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
        $res   = [];
        $words = $this->wordData;
        foreach ($words as $key => $value) {
            $tag     = $value['word'];
            $replace = implode('-???-', preg_split('/(?<!^)(?!$)/u', $tag));

            $pos = strpos($content, $tag);
            if ($pos === false) {
                continue;
            }
            $content = substr_replace($content, $replace, $pos, strlen($tag));
            $res[]   = $value;
        }
        return $res;
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
        $words = $this->wordData;
        foreach ($words as $key => $value) {
            $tag     = $value['word'];
            $tmp     = implode('-???-', preg_split('/(?<!^)(?!$)/u', $tag));
            $replace = '<a href="' . $value['url'] . '" ' . $newclass . '>' . $tmp . '</a>';
            $content = $this->str_replace_once($content, $tag, $replace);
        }
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
