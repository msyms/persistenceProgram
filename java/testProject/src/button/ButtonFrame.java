package button;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ButtonFrame extends JFrame {
    private JPanel buttonPanel;
    private static final int DEFAULT_WIDTH = 300;
    private static final int DEFAULT_HEIGHT = 200;

    public ButtonFrame()
    {
        setSize(DEFAULT_WIDTH, DEFAULT_HEIGHT);

        buttonPanel = new JPanel();
        makeButton("Yellow",Color.YELLOW);
        makeButton("Blue",Color.BLUE);
        makeButton("Red",Color.RED);
        add(buttonPanel);

        /*JButton yellowButton = new JButton("Yellow");
        JButton blueButton = new JButton("Blue");
        JButton redButton = new JButton("Red");

        buttonPanel = new JPanel();

        buttonPanel.add(yellowButton);
        buttonPanel.add(blueButton);
        buttonPanel.add(redButton);

        add(buttonPanel);



        ColorAction yellowAction = new ColorAction(Color.YELLOW);
        ColorAction blueAction = new ColorAction(Color.BLUE);
        ColorAction redAction = new ColorAction(Color.RED);

        yellowButton.addActionListener(yellowAction);
        blueButton.addActionListener(blueAction);
        redButton.addActionListener(redAction);
*/
    }

    public void makeButton(String name, Color backgroundColor)
    {
        JButton button = new JButton(name);
        buttonPanel.add(button);
        button.addActionListener(event ->buttonPanel.setBackground(backgroundColor));
    }

    private class ColorAction implements ActionListener
    {
        private Color backgroundColor;

        public ColorAction(Color c)
        {
            backgroundColor = c;
        }

        public void actionPerformed(ActionEvent event)
        {
            buttonPanel.setBackground(backgroundColor);
        }
    }
}
