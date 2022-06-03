<?php
//problem#1
interface MediaPlayer
{
    public function play(string $audioType, string $fileName);
}

interface AdvanceMediaPlayer
{
    public function playVlc(string $fileName);
    public function playMp4(string $fileName);
}

class VlcPlayer implements AdvanceMediaPlayer
{
    protected $filename;
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function playVlc(string $fileName)
    {
        echo 'Plying vlc File '.$fileName.'<br>';
    }

    public function playMp4(string $fileName)
    {
        echo 'playing a mp4 file '.$fileName.' <br>';
    }
}

class Mp4Player implements AdvanceMediaPlayer
{
    protected $filename;
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }
    public function playVlc(string $fileName)
    {
        echo 'Plying vlc File '.$fileName.'<br>';
    }

    public function playMp4(string $fileName)
    {
        echo 'playing a mp4 file '.$fileName.' <br>';
    }
}

class MediaAdapter implements MediaPlayer
{
    protected $filename;
    protected $audioType;
    public function __construct(string $filename, string $audioType, AdvanceMediaPlayer $obje)
    {
        $obje = AdvanceMediaPlayer::class;
        $this->filename = $filename;
        $this->audioType = $audioType;

    }
    public function mediaAdapter(string $audioType)
    {
        if ($audioType == "vlc")
        {
            $obje = new VlcPlayer();
        }
        if ($audioType == "mp4")
        {
            $obje = new Mp4Player();
        }
    }

    public function play(string $audioType, string $fileName)
    {
        if ($audioType == 'vlc')
        {
            $obje = 3;
        }
    }
}

//problem#2
//The Adapter pattern allows you to use 3rd-party or legacy classes even if they’re incompatible with the bulk of your code.
//For example, instead of rewriting the notification interface of your app to support each 3rd-party service such as Slack,
//Facebook, SMS or (you-name-it), you can create a set of special wrappers that adapt calls from your app to an interface
//and format required by each 3rd-party class.

interface Notification
{
    public function send(string $title, string $message);
}

class EmailNotification implements Notification
{
    private $email;
    public function __construct(string $email)
    {
        $this->email = $email;
    }
    public function send(string $title, string $message)
    {
//        mail($this->email, $title, $message);
        echo "Send email with title '$title' to '$this->email' that says '$message'". '<br>';
    }
}

class SlackApi
{
    private $login; private $apiKey;
    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    public function login()
    {
        echo 'Logged into a slack account '.$this->login.' <br>';
    }
    public function sendMessage(string $chatId, string $message)
    {
        echo 'Posted following message into the '.$chatId.' chat:'.$message.' <br>';
    }

}
class SlackNotification implements Notification
{
    private $slack;
    private $chatId;

    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->chatId = $chatId;
        $this->slack = $slack;
    }
    public function send(string $title, string $message)
    {
        $slackMessage = "#".$title."# ".strip_tags($message);
        $this->slack->login();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }
}

function clientCode(Notification $notification)
{
    echo $notification->send("Salary Report",  "<strong style='color:red;font-size: 50px;'>Alert!</strong> " ."your slaray slip is ready. Please visit to HR table");

}

echo "Client code is design correctly and works with emai lnotifiction  :<br>";

$notification = new EmailNotification('mubasharhussain@carbonteq.com', "Subject line");
clientCode($notification);

echo "The same client code can work with other classes via adapter:".'<br>';
$slackApi = new SlackApi("mubashar.hussain@brokergenius.com", "XXXXXXXX");
$notification2 = new SlackNotification($slackApi, "mubashar.hussain@brokergenius.com");
clientCode($notification2);
