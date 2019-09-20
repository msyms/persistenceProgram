<?php
abstract class Player
{
    protected $name;
    
    function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function Attack();
    abstract public function Defense();
}

class Forwards extends Player
{
    public function Attack()
    {
        echo '前锋：'.$this->name.'进攻\n';
    }

    public function Defense()
    {
        echo "前锋:".$this->name." 防守\n";
    }

}

class Center extends Player
{
    public function Attack()
    {
        echo '中锋：'.$this->name.'进攻\n';
    }

    public function Defense()
    {
        echo "中锋:".$this->name." 防守\n";
    }

}


class ForeignCenter
{
    private $name;
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name; 
    }
    public function 进攻()
    {
        echo "外籍中锋:".$this->name." 进攻\n";
    }

    public function 防守()
    {
        echo "外籍中锋:".$this->name." 防守\n";
    }
}

class Translator extends Player
{
    private $foreignCenter;

    function __construct($name)
    {
        $this->foreignCenter = new ForeignCenter;
        $this->foreignCenter->setName($name);   
    }
    public function Attack()
    {
        $this->foreignCenter->进攻();
    }

    public function Defense()
    {
        $this->foreignCenter->防守();
    }
}

$forwards = new Forwards('bde');
$forwards->Attack();
$forwards->Defense();

$translator = new Translator('姚明');
$translator->Attack();
$translator->Defense();

interface MediaPlayer
{
    public function play($audiotype,$filename);
}

interface AdvancedMediaPlayer
{
    public function playVlc($filename);
    public function playMp4($filename);
}

class VlcPlayer implements AdvancedMediaPlayer
{
    public function playVlc($filename)
    {
        echo 'playing vlc'.$filename;
    }

    public function playMp4($filename)
    {
        
    }
}

class Mp4Player implements AdvancedMediaPlayer
{
    public function playVlc($filename)
    {
        
    }

    public function playMp4($filename)
    {
        echo 'playing mp4'.$filename;
    }
}

class MediaAdapter implements MediaPlayer
{
    private $advancedMusicPlayer;
    public function __construct($audioType)
    {
        if($audioType == 'vlc') {
            $this->advancedMusicPlayer = new VlcPlayer();
        } elseif($audioType =='mp4') {
            $this->advancedMusicPlayer = new Mp4Player();
        }
    } 

    public function play($audiotype, $filename)
    {
        if($audiotype == 'vlc') {
            $this->advancedMusicPlayer->playVlc($filename);
        }
        if($audiotype == 'mp4') {
            $this->advancedMusicPlayer->playMp4($filename);
        }

    }
}

interface SDCard
{
    public function readSD();
    public function writeSD($msg);
}

class SDCardImpl implements SDCard
{
    private $msg;
    public function readSD()
    {
        return $this->msg;
    }

    public function writeSD($msg)
    {
        $this->msg = $msg;
    }
}
