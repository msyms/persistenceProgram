package com.dong.connection;

import org.junit.Test;

import java.io.IOException;
import java.io.InputStream;
import java.sql.Connection;
import java.sql.Driver;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Properties;

public class ConnectionTest {
    @Test
    public void testConnection1() throws SQLException {
        Driver dirver = new com.mysql.cj.jdbc.Driver();
        String Url = "jdbc:mysql://localhost:3306/shop";
        Properties properties = new Properties();
        properties.setProperty("user","root");
        properties.setProperty("password","root");
        Connection connect = dirver.connect(Url, properties);
        System.out.println(connect);
    }

    @Test
    public void testConnection2() throws Exception {
        Class clazz = Class.forName("com.mysql.cj.jdbc.Driver");
        Driver driver = (Driver) clazz.getDeclaredConstructor().newInstance();

        String Url = "jdbc:mysql://localhost:3306/shop";
        Properties properties = new Properties();
        properties.setProperty("user","root");
        properties.setProperty("password","root");

        Connection connect = driver.connect(Url, properties);

        System.out.println(connect);
    }

    @Test
    public void testConnection4() throws Exception {
        Class clazz = Class.forName("com.mysql.cj.jdbc.Driver");
        Driver driver = (Driver) clazz.getDeclaredConstructor().newInstance();

        DriverManager.registerDriver(driver);
        String Url = "jdbc:mysql://localhost:3306/shop";
        String user = "root";
        String password = "root";
        Connection connection = DriverManager.getConnection(Url, user, password);

        System.out.println(connection);
    }

    @Test
    public void testConnection5() throws Exception {

        String Url = "jdbc:mysql://localhost:3306/shop";
        String user = "root";
        String password = "root";

        Class.forName("com.mysql.cj.jdbc.Driver");
//        Driver driver = (Driver) clazz.getDeclaredConstructor().newInstance();
//
//        DriverManager.registerDriver(driver);
//
        Connection connection = DriverManager.getConnection(Url, user, password);

        System.out.println(connection);
    }

    @Test
    public void getConnection() throws Exception {
        InputStream resourceAsStream = ConnectionTest.class.getClassLoader().getResourceAsStream("jdbc.properties");
        Properties properties = new Properties();
        properties.load(resourceAsStream);

        String user = properties.getProperty("user");
        String password = properties.getProperty("password");
        String url = properties.getProperty("url");
        String driverClass = properties.getProperty("driverClass");

        Class.forName(driverClass);

        Connection connection = DriverManager.getConnection(url, user, password);

        System.out.println(connection);

    }
}
