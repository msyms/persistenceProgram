package plaf;

import javax.swing.*;
import java.awt.*;

public class PlafFrameTest {

    public static void main(String[] args) {
        EventQueue.invokeLater(()->{
            JFrame PlafFrame = new PlafFrame();
            PlafFrame.setTitle("PlafFrameTest");
            PlafFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            PlafFrame.setVisible(true);
        });
    }
}

class PlafFrame extends JFrame
{
    private JPanel buttonPanel;
    public PlafFrame()
    {
        //主题
        buttonPanel = new JPanel();
        //获取系统所有主题
        UIManager.LookAndFeelInfo[] infos = UIManager.getInstalledLookAndFeels();
        for(UIManager.LookAndFeelInfo info : infos)
            makeButton(info.getName(), info.getClassName());
        add(buttonPanel);
        pack();
    }

    private void makeButton(String name, String className)
    {
        JButton button = new JButton(name);

        buttonPanel.add(button);

        button.addActionListener(event->{
            try
            {
                //设置主题
                UIManager.setLookAndFeel(className);
                //刷新全部组件集
                SwingUtilities.updateComponentTreeUI(this);
                pack();
            } catch (Exception e)
            {
                e.printStackTrace();
            }
        });
    }
}
