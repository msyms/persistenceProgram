package button;

import javax.swing.*;
import java.awt.*;

public class buttonTest {
    public static void main(String[] args)
    {
        EventQueue.invokeLater(()->{
            JFrame frame = new ButtonFrame();
            frame.setTitle("buttonTest");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setVisible(true);
        });
    }
}
