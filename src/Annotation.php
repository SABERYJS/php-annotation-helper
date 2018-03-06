<?php
/**
 * Created by PhpStorm.
 * User: saberyjs
 * Date: 18-3-5
 * Time: 下午8:56
 */
namespace  saberyjs\annotation;


use saberyjs\exception\ClassNotFoundException;

class  Annotation{
    /**
     * @param  $target  string|\ReflectionClass|\ReflectionMethod
     * @param  $throw bool
     * @return  string
     * @throws  \ReflectionException |ClassNotFoundException
     * **/
    public static function getAnnotation($target,$throw=true){
        if(is_string($target)){
            if(class_exists($target)){
                $relClass=new \ReflectionClass($target);
                return $relClass->getDocComment();
            }else{
                if(!empty($throw)){
                    throw  new ClassNotFoundException("$target not found");
                }else{
                    return '';
                }
            }
        }else{
            if(is_object($target)){
                if($target instanceof \ReflectionClass || $target instanceof  \ReflectionMethod){
                    return $target->getDocComment();
                }else{
                    throw  new \InvalidArgumentException(' target must be  implement Reflector interface when is is a object');
                }
            }else{
                throw new \InvalidArgumentException('target must be type[object] or string');
            }
        }
    }

    /**
     *
     * @param  $annotation string
     * @param  $parser Parser
     * @return  mixed
     * @throws  \InvalidArgumentException
     * **/
    public static function  parseAnnotation($annotation,Parser $parser=null){
        if(empty($annotation)){
            return null;
        }
        if(!is_string($annotation)){
            throw  new \InvalidArgumentException('$annotation must be string');
        }
        if(empty($parser)){
            $parser=new StandardAnnotationParser();
        }

        if (!is_object($parser)||!$parser instanceof Parser){
            throw  new \InvalidArgumentException('$parser must instance of Parser');
        }

        return $parser->parse($annotation);
    }
}