<?php
//In this example, the Factory Method pattern provides an interface for creating social network connectors,
//which can be used to log in to the network, create posts and potentially perform other activities—and all
//of this without coupling the client code to specific classes of the particular social network.

abstract class SocialNetwork
{

    abstract public function getNetwork(): NetworkConnector;

    public function post($content): void
    {
        $network = $this->getNetwork();
        $network->login();
        $network->createPost($content);
        $network->logout();
    }
}

class FacebookPost extends SocialNetwork
{
    private $login, $password;
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    public function getNetwork(): NetworkConnector
    {
        // TODO: Implement getSocialNetwork() method.
        return new FacebookConnector($this->login, $this->password);
    }
}

class GooglePost extends SocialNetwork
{
    private $username, $password;
    public function __construct($username, $password)
    {
        $this->username = $username; $this->password = $password;
    }

    public function getNetwork(): NetworkConnector
    {
        // TODO: Implement getSocialNetwork() method.
        return new GoogleConnection($this->username, $this->password);
    }
}

interface NetworkConnector
{
    public function login();

    public function createPost($content);

    public function logout();
}

class FacebookConnector implements NetworkConnector
{
    private $login, $password;
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function login()
    {
        echo 'Send Api request to login user '.$this->login.' and password: '.$this->password."<br>";
    }
    public function logout()
    {
        echo "Send HTTP API request to log out user $this->login \n"."<br>";
    }
    public function createPost($content)
    {
        echo "Api request to create Post for facebook \n".$content."<br>";
    }
}

class GoogleConnection implements NetworkConnector
{
    private $username, $password;
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }


    public function login()
    {
        // TODO: Implement login() method.
        echo 'Google Conneciton login with username '.$this->username.' and password:'.$this->password.'<br>';
    }
    public function logout()
    {
        // TODO: Implement logout() method.
        echo 'Google Connection Logout <br>';
    }
    public function createPost($content)
    {
        // TODO: Implement createPost() method.
        echo 'Google Connection Create Post content:'.$content.'<br>';
    }
}

function clientCode(SocialNetwork $creator)
{
    $creator->post("Hello world!");
//    $creator->post("I had a large hamburger this morning!");
}

echo "Testing ConcreteCreator1:\n"."<br>";
clientCode(new FacebookPost("john_smith", "******"));
echo "\n\n"."<br>";

echo "*******************************************************************************"."<br>";

echo "Testing ConcreteCreator2:\n"."<br>";
clientCode(new GooglePost("john_smith", "******"));
echo "\n\n"."<br>";




