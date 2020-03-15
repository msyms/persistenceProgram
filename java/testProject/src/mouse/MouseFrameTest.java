package mouse;

import javax.swing.*;
import java.awt.*;

public class MouseFrameTest {
    public static void main(String[] args)
    {
        EventQueue.invokeLater(()->{
            JFrame frame = new MouseFrame();
            frame.setTitle("MouseFrameTest");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setVisible(true);
        });


    }
}
