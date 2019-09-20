<?php

/**
 * 
 * 
 * 【主要角色】
抽象工厂(Abstract Factory)角色：它声明一个创建抽象产品对象的接口。通常以接口或抽象类实现，所有的具体工厂类必须实现这个接口或继承这个类。
具体工厂(Concrete Factory)角色：实现创建产品对象的操作。客户端直接调用这个角色创建产品的实例。这个角色包含有选择合适的产品对象的逻辑。通常使用具体类实现。
抽象产品(Abstract Product)角色：声明一类产品的接口。它是工厂方法模式所创建的对象的父类，或它们共同拥有的接口。
具体产品(Concrete Product)角色：实现抽象产品角色所定义的接口，定义一个将被相应的具体工厂创建的产品对象。其内部包含了应用程序的业务逻辑。

 */

class User
{
    private $id = null;
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId($id)
    {
        return $this->id;
    }
    private $name = null;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Department
{
    private $id = null;
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId($id)
    {
        return $this->id;
    }
    private $name = null;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

interface IUser
{
    public function insert(User $user);
    public function getUser($id);
}

class SqlserverUser implements IUser
{
    public function insert(User $user)
    {
        echo "往sql Server中 插入数据";
    }

    public function getUser($id)
    {
        echo "根据id获取sql Server数据";
    }
}

class AcessUser implements IUser
{
    public function insert(User $user)
    {
        echo "往Access 插入数据";
    }
    public function getUser($id)
    {
        echo "根据id 获取access中的数据";
    }
}

interface IDepartment
{
    public function insert(Department $user);
    public function getDepartment($id);
}

class SqlserverDepartment implements IDepartment 
{
    public function insert(Department $department)
    {
        echo "往SQL Server中的Department表添加一条记录\n";
    }

    public function getDepartment($id)
    {
        echo "根据id得到SQL Server中Department表一条记录\n";
    }
}

class AcessDepartment implements IDepartment 
{
    public function insert(Department $department)
    {
        echo "往Acess Server中的Department表添加一条记录\n";
    }

    public function getDepartment($id)
    {
        echo "根据id得到Acess Server中Department表一条记录\n";
    }
}

// interface IFactory
// {
//     public function CreateUser();
//     public function CreateDepartment();
// }

// class SqlserverFactory implements IFactory
// {
//     public function CreateUser()
//     {
//         return new SqlserverUser();
//     }

//     public function CreateDepartment()
//     {
//         return new SqlserverDeparetment();
//     }
// }
class DataBase
{
    const DB = 'Sqlserver';

    public static function CreateUser()
    {
        $class = static::DB.'User';
        return new $class();
    }

    public static function CreateDepartment()
    {
        $class = static::DB.'Department';
        return new $class();
    }
}

$user = new User();
$iu = DataBase::CreateUser();
$iu->insert($user);
$iu->getUser(1);



