<?php
/**
 * Created by PhpStorm.
 * User: saberyjs
 * Date: 18-3-6
 * Time: 上午8:32
 */
namespace  saberyjs\annotation;

interface  Parser {
    /**
     * @param  $doc string
     * @return  array|null
     * **/
    public function parse($doc);
}