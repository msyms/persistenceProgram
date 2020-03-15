package lyons.entity;

/**
 * Created by cv on 2018/10/19.
 */
public final class SalesMan {

    private int sId;
    private String sName;
    private String sPassWord;

    public SalesMan(int sId,String sPassWord)
    {
        this.sId = sId;
        this.sPassWord = sPassWord;
    }

    public SalesMan(int sId, String sName, String sPassWord)
    {
        this.sId = sId;
        this.sName = sName;
        this.sPassWord = sPassWord;
    }

    public SalesMan(String sName,String sPassWord)
    {
        this.sName = sName;
        this.sPassWord = sPassWord;
    }
    public int getSId()
    {
        return sId;
    }
    public void setSId(int id)
    {
        sId = id;
    }
    public String getSName()
    {
        return sName;
    }
    public void setSName(String name)
    {
        sName = name;
    }
    public String getSPassWord()
    {
        return sPassWord;
    }
    public void setSPassWord(String passWord)
    {
        sPassWord = passWord;
    }

}
