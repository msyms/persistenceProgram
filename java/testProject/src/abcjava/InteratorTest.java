package abcjava;

import java.util.Collection;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;

public class InteratorTest {
    public static void main(String[] args)
    {
        Collection c = new HashSet();
        c.add(new Name("f1","l1"));
        c.add(new Name("f2","l2"));
        c.add(new Name("f3","l3"));
        Iterator i = c.iterator();
        while (i.hasNext()){
            //删除元素的时候可以用i.remove()来删除比较安全
            //运行Iterator时，元素锁定，只能用Iterator来删除元素
            Name n = (Name)i.next();
            System.out.print(n.getFirstName() + " ");
        }

        Set s = new HashSet();
        s.add("hello");s.add(1);s.add("c");
        Set s1 = new HashSet();
        s1.add("hello1");s.add(2);s.add("c");

        Set sn = new HashSet(s);
        Set su = new HashSet(s1);
        sn.retainAll(su);
        su.addAll(sn);

    }
}
