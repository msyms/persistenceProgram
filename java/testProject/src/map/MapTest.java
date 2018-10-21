package map;



import interfaces.Employee;

import java.util.*;
public class MapTest {
    public static void main(String[] args)
    {
        Map<String, Employee> staff = new HashMap<>();
        staff.put("133-25-5464", new Employee("Amy lee",4010));
        staff.put("567-25-5464", new Employee("Harry lee",4004));
        staff.put("157-25-5464", new Employee("Gary lee",4007));
        staff.put("456-25-5464", new Employee("Francesca lee",4007));

        System.out.println(staff);

        staff.remove("567-25-5464");

        staff.put("456-25-5464", new Employee("Francesca",8967));

        System.out.println(staff.get("157-25-5464"));

        staff.forEach((k,v) -> System.out.println("key=" + k + "， value= " + v));
    }
}
