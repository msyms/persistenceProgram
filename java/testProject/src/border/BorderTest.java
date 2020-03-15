package border;

import bounce.BounceFrame;

import javax.swing.*;
import java.awt.*;

public class BorderTest {
    public static void main(String[] args)
    {
        EventQueue.invokeLater(()->{
            JFrame frame = new BorderFrame();
            frame.setTitle("Border");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setVisible(true);
        });
    }
}
