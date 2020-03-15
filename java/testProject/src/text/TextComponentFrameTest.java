package text;

import javax.swing.*;
import java.awt.*;
import java.util.Queue;

public class TextComponentFrameTest {
    public static void main(String[] args)
    {
        EventQueue.invokeLater(()->{
            JFrame frame = new TextComponentFrame();
            frame.setTitle("Text");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setVisible(true);
        });


    }
}
