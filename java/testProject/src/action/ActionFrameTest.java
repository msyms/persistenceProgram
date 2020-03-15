package action;

import javax.swing.*;
import java.awt.*;

public class ActionFrameTest {
    public static void main(String[] args)
    {
        EventQueue.invokeLater(()->{
            JFrame frame = new ActionFrame();
            frame.setTitle("ActionFrameTest");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setVisible(true);

        });
    }
}
