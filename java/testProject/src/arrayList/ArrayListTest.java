package arrayList;

import inheritance.Employee;

import java.util.*;
public class ArrayListTest {
    public static void main(String[] args)
    {
        ArrayList<Employee> staff = new ArrayList<>();
        staff.add(new Employee("carl cralcker",75000,1989,12,15));
        staff.add(new Employee("hack cralcker",75000,1989,12,15));
        for(Employee e : staff)
            e.raiseSalary(5);
        for(Employee e:staff)
            System.out.println("name=" + e.getName() + ",salary=" + e.getSalary() + ",hireDay="
                    + e.getHireDay());
    }
}
