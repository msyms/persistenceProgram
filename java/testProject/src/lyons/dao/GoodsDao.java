package lyons.dao;


import lyons.db.DbClose;
import lyons.db.DbConn;
import lyons.entity.Goods;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

/**
 * Created by cv on 2018/10/19.
 */
public final class GoodsDao {
    Connection    conn = null;
    PreparedStatement   pstmt = null;
    ResultSet       rs = null;

    /**
     * 1.添加商品到数据库goods表
     * @param goods 商品对象
     * @return boolean
     */

    public boolean addGoods(Goods goods)
    {
        boolean bool = false;
        conn = DbConn.getCoon();
        String sql = "INSERT INTO GOODS(GNAME,GPRICE,GNUM) VALUES(?,?,?)";
        try
        {
            pstmt = conn.prepareStatement(sql);
            pstmt.setString(1,goods.getGname());
            pstmt.setDouble(2,goods.getGprice());
            pstmt.setInt(3,goods.getGnum());

            int rs = pstmt.executeUpdate();
            if(rs > 0)
            {
                bool = true;
            }
        } catch (SQLException e)
        {
            e.printStackTrace();
        } finally {
            DbClose.addClose(pstmt,conn);
        }
        return bool;
    }

    public boolean updateGoods(int key,Goods goods)
    {
        boolean bool = false;
        conn = DbConn.getCoon();
        switch (key)
        {
            case 1:
                String sqlName = "UPDATE GOODS SET GNAME=? WHERE GID=?";
                try
                {
                    pstmt = conn.prepareStatement(sqlName);
                    pstmt.setString(1,goods.getGname());
                    pstmt.setInt(2,goods.getGid());

                    int rs = pstmt.executeUpdate();
                    if (rs > 0)
                    {
                        bool = true;
                    }
                } catch (SQLException e)
                {
                    e.printStackTrace();
                }finally{
                    DbClose.addClose(pstmt,conn);
                }
                break;
            case 2:
                String sqlPrice = "UPDATE GOODS SET GPRICE=? WHERE GID=?";

                try
                {
                    pstmt = conn.prepareStatement(sqlPrice);
                    pstmt.setDouble(1, goods.getGprice());
                    pstmt.setInt(2,goods.getGid());

                    int rs = pstmt.executeUpdate();
                    if (rs > 0)
                    {
                        bool = true;
                    }
                } catch (SQLException e)
                {
                    e.printStackTrace();
                }finally{
                    DbClose.addClose(pstmt,conn);
                }
                break;
            case 3:
                String sqlNum = "UPDATE GOODS SET GNUM=? WHERE GID=?";

                try
                {
                    pstmt = conn.prepareStatement(sqlNum);
                    pstmt.setInt(1, goods.getGnum());
                    pstmt.setInt(2,goods.getGid());

                    int rs = pstmt.executeUpdate();
                    if (rs > 0)
                    {
                        bool = true;
                    }
                } catch (SQLException e)
                {
                    e.printStackTrace();
                }finally{
                    DbClose.addClose(pstmt,conn);
                }
                break;
            default:
                break;

        }
        return bool;
    }

}
