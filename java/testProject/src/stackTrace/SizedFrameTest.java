package stackTrace;

import java.awt.*;
import javax.swing.*;



public class SizedFrameTest {
    public static void main(String[] args)
    {
        EventQueue.invokeLater(()->
        {
            JFrame frame = new SizedFrame();
            frame.setTitle("SizedFrame");
            frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            frame.setVisible(true);
        });
    }
}

class SizedFrame extends JFrame
{
    public SizedFrame()
    {
        Toolkit kit = Toolkit.getDefaultToolkit();
        Dimension screenSize = kit.getScreenSize();
        int screenHeight = screenSize.height;
        int screenWidth = screenSize.width;

        // set frame width,height and left platform pick screen location

        setSize(screenWidth / 2, screenHeight / 2);
        setLocationByPlatform(true);

        //set frame icon

        Image img = new ImageIcon("icon.gif").getImage();
        setIconImage(img);
    }
}