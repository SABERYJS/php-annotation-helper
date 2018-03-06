<?php
/**
 * Created by PhpStorm.
 * User: saberyjs
 * Date: 18-3-6
 * Time: 上午8:43
 */
namespace saberyjs\annotation;
/**
 *
 * **/
class  PlainAnnotationParser implements Parser{
    public function parse($doc)
    {
        // TODO: Implement parse() method.
        $pattern='/^\/([\s*]+)|([\s*]+)\/$/i';
        $condPattern='/^\s*(\w+):([\s\S]*)$/i';
        $parts=explode('*',preg_replace($pattern,'',$doc));
        if(empty($parts)){
            return null;
        }

        $ret=[];

        foreach ($parts as $pt){
            $pt=trim($pt);
            if(empty($pt)){
                continue;
            }
            if(preg_match($condPattern,$pt,$match)){
                $ret[]=[
                    'name'=>$match[1],
                    'value'=>$match[2]
                ];
            }else{
                continue;
            }
        }

        return !empty($ret)?$ret:null;
    }
}