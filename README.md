## why need this library

if you have  used **ReflectionClass** or **ReflectionMethod** of php,you will find that there is a method called **getDocComment**
,it means that we can get comment  of specified class (and method of class),so,we can do something with it.
do you remember Java web Annotation ?? it is a powerful develop tool,but ,this library do not that,it on parse comment,because we never know what you want to do,right ??

## how to use

this library support two function ,as follows:

### get doc comment

firstly we  assume there is class called Student:

```php
class  Student{
    /**
     * @type post
     * @https true
     * **/
    public function  getName(){
        return '';
    }
}
```

```php
$doc=\saberyjs\annotation\Annotation::getAnnotation();
```

Annotation::getAnnotation() return a raw string

### parse comment

before we get into real code,we must understand that there is a concept called parser,each kind of parser must 
implement interface called *Parser*, the interface is very simple,i will show you the code:

```php
namespace  saberyjs\annotation;

interface  Parser {
    /**
     * @param  $doc string
     * @return  array|null
     * **/
    public function parse($doc);
}
```

every parser must implement *parse* method,it is the only method,this library has two internal parser ,*StandardAnnotationParser* and *PlainAnnotationParser*,of course,you can write your own parser(must implement *Parser* interface) whenever you want .
if you use StandardAnnotationParser,code as follows:
```php
$doc=\saberyjs\annotation\Annotation::getAnnotation(Student::class);
$parser=new \saberyjs\annotation\StandardAnnotationParser();
$parts=\saberyjs\annotation\Annotation::parseAnnotation($doc,$parser);
```
if you remember the class called *Student*,you will find that it has a method called *getName*,the method has some comment,we paste it here
```php
/**
     * @type post
     * @https true
     * **/
```
so after you called *Annotation::parseAnnotation* method with StandardAnnotationParser ,you will get a array,it`s format as follows:
```php
$ret=[[
    'name'=>'type',
    'value'=>'post'
    ],[
       'name'=>'https',
       'value'=>'true'
    ]
];
```
you can do  whatever you want with $ret,if you are interested in it,you can read  the composer package called **thinkphp5-route-helper**

## Contact

I am a php developer in **ShenZhen of China**,if you also like open source ,you can contact me ,My QQ is **1174332406**

last but not least,have a nice day!!

[reflClass]:http://php.net/manual/zh/class.reflectionclass.php
[reflMethod]:http://php.net/manual/zh/class.reflectionmethod.php