<?php
/**
 * Created by PhpStorm.
 * User: saberyjs
 * Date: 18-3-6
 * Time: 上午8:32
 */
namespace  saberyjs\annotation;
class  StandardAnnotationParser implements Parser{
    public  function parse($annotation)
    {
        // TODO: Implement parse() method.
        $pattern='/^\/([\s*]+)|([\s*]+)\/$/i';
        $conditionPattern='/^@(\w+)\s+([\s\S]+)$/i';
        $parts=explode('*',preg_replace($pattern,'',$annotation));
        $ret=[];
        if(empty($parts)){
            return null;
        }else{
            foreach ($parts as $pt){
                $pt=trim($pt);
                if(empty($pt)){
                    continue;
                }
                if(preg_match($conditionPattern,$pt,$match)){
                    $ret[]=[
                        'name'=>$match[1],
                        'value'=>$match[2]
                    ];
                }else{
                    continue;
                }
            }
            return empty($ret)?null:$ret;
        }
    }
}