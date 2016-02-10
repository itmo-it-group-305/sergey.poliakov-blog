<?php
class Person
{
    private $uid = 0;
//    это свойство по умлочанию, только константное значение
    public $firstname;
    public $lastname;
    public $patro;
    protected $forTest = 666;

    public function __construct($lastname, $firstname, $patro) {
        $this->uid = uniqid();
//        выдает уникальное знаение в рамках текущего скрипта, быстрая замена
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->patro = $patro;
    }

    public function getFullName()
    {
        return $this->lastname .
        $this->firstname .
        $this->patro;
    }
}

class Developer extends Person
{
    protected $skills = [];

    public function __construct($lastname, $firstname, $patro, $skills) {
        parent:: __construct($lastname, $firstname, $patro);
        $this->$skills = $skills;
//        var_dump($this->$uid) так нельзя
        var_dump($person->$skills);
        var_dump($person->$forTest);
    }

    public function getFullName()
    {
        return parent::getFullname() . implode(',', $this->skills);
    }

}

//$this - ссылка на текущщий объект. Работает только в контексте объекта

$person = new Person();

$person->firstname = 'Popkin';
$person->lastname = 'Piska';

echo $person->firstname;
echo $person->lastname;

$person->age = 150;

var_dump($person);

$persond = new Person('Piska', 'Popkin', 'Zhopkin');
$person3 = new Developer('Pi2ska', 'Pop2kin', 'Zhop2kin', ['php', 'javascript']);

echo $persond->getFullName();
echo $person3->getFullName();

var_dump($persond);
var_dump($person3);


class Foo {
    protected static $prop = 'Foo';
    public static function get()
    {
        echo static::$prop;
//        Если бы тут был self то наследуемый класс тоже давал бы Foo
    }
}

class Bar extends Foo {
    protected static $prop = 'Bar';
}


Foo::get();
Bar::get();

class Team
{
    protected $developers = [];

//    Всегда лучше всё закрывать, то есть лучше использовать protected
//    Сначала всё закрывать, потом открывать

    public function addDeveloper(Developer $developer)
    {
        array_push($this->developers, $developer);
    }
}

$team = new Team();
//$team->addDeveloper($person);
$team->addDeveloper($person3);
//$team->addDeveloper(666);
var_dump($team);
//var_dump($person->$uid) так нельзя

// clone полезно при создании игр, но смысла особого нет, удобнее через new сделать новый объект (или клонировать прототип)

//PUBLIC - открытый
//PROTECTED - защищенный
//PRIVATE - закрытый, только в текущем классе

//Двойное двоеточкие - позволяет обращаться к статическим свойствам
//parent:: - переопределенный родительстий метод
//self:: - ссылка на текущий класс
//staticLL - позднее статическое связываемое, вызываемый класс

//class Config
//{
//    protected static $params = [];
//
//    public static function add($name, $value)
//    {
//        self::params[$name] = $value;
//    }
//
//    public function get($name)
//    {
//        return isset($this->params[$name]) ? $this->params[$name] : null;
//    }
//
//    public function getAll()
//    {
//        return $this->params[$name];
//    }
//
//    public function set($name, $value)
//    {
//        if(isset($this->params[$name]))
//        {
//        $this->params[$name] = $value;
//        }
//    }
//}

//Context Component 1
$config = new Config();
$config->add('db_host', 'localhost');
var_dump($config->get('db_host'));

//Context Component 2
$config2 = new Config();
$config2->add('casche_host', 'localddhost');
var_dump($config2->get('casche_host'));

var_dump($config, $config2);