package comboBox;

import javax.swing.*;
import java.awt.*;

public class ComboBoxFrame extends JFrame {
    private JComboBox<String> faceCombo;
    private JLabel label;
    private static final int DEFAULT_SIZE = 24;

    public ComboBoxFrame()
    {
        label = new JLabel("The quick brown fox jumps over the lazy dog.");
        label.setFont(new Font("serif",Font.PLAIN, DEFAULT_SIZE));
        add(label, BorderLayout.CENTER);

        faceCombo = new JComboBox<>();
        faceCombo.addItem("Serif");
        faceCombo.addItem("SansSerif");
        faceCombo.addItem("Monospaced");
        faceCombo.addItem("Dialog");
        faceCombo.addItem("DialogInput");

        faceCombo.addActionListener(event->
            label.setFont(
                    new Font(faceCombo.getItemAt(faceCombo.getSelectedIndex()),
                            Font.PLAIN,DEFAULT_SIZE)));
        JPanel comboPanel = new JPanel();
        comboPanel.add(faceCombo);
        add(comboPanel, BorderLayout.SOUTH);
        pack();
    }
}
