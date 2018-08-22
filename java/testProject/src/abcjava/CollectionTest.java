package abcjava;

/**
 * collection接口存取一组对象
 * 子接口：Set  List
 *  Set:没有顺序，不可重复
 *  List:有顺序，可重复
 *  所有实现了此接口的容器类都有一个iterator方法，返回一个实现了iterator接口的对象，用来遍历容器
 */

import java.util.*;
public class CollectionTest {
        public static void main(String[] args)
        {
            Collection c= new ArrayList();//HashSet
            //父类引用指向子类对象，不能访问子类对象所特有的东西
            //c 可以放入不同的对象
            c.add("hello");
            c.add(new Name("f1","11"));
            c.add(new Integer(100));
            // 删除对象，根据equals 判断对象
            //
            System.out.println(c.size());
            System.out.println(c);
        }
}

