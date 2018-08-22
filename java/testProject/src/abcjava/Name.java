package abcjava;

public class Name implements Comparable {
    private String firstName,lastName;
    public Name(String firstName,String lastName)
    {
        this.firstName = firstName;
        this.lastName = lastName;
    }
    public String getFirstName() {return firstName;}
    public String getLastName() {return lastName;}
    public String toString() {return firstName + " " + lastName;}
    /**
     * 重写name的equals的方法
     * Name类的父类是object类，object类的euqals方法是当前对象和传进来的对象是否一个对象
     */

    public boolean equals(Object obj) {
        if(obj instanceof Name){
            Name name = (Name) obj;
            return (firstName.equals(name.firstName)) &&(lastName.equals(name.lastName));
        }
        return super.equals(obj);
    }

    /**
     * 重写equals方法，必须重写hashCode方法
     */
    public int hashCode(){
        return firstName.hashCode();
    }

    /**
     * 实现Comparable接口的compareTo方法，便可以实现此类对象的比较大小和排序
     * @param o
     * @return
     */
    public int compareTo(Object o) {
        Name n = (Name) o;
        int lastCmp = lastName.compareTo(n.lastName);
        return (lastCmp != 0 ? lastCmp : firstName.compareTo(n.firstName));
    }
}
