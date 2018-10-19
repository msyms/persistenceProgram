package lyons.db;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

/**
 * 连接数据库
 * Created by cv on 2018/10/19.
 */
public final class DbConn {
    public static Connection getCoon()
    {
        Connection conn = null;

        String user = "root";
        String passwd = "root";
        String url = "jdbc:mysql://localhost:3306/RUNOOB";

        try
        {
            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection(url,user,passwd);
        } catch (SQLException e)
        {
            e.printStackTrace();
        }
        catch (ClassNotFoundException e)
        {
            e.printStackTrace();
        }
        return conn;
    }
}
