<?php
//This example shows you how to clone a complex Page object using the Prototype pattern.
//The Page class has lots of private fields, which will be carried over to the cloned object thanks to the Prototype pattern.

class Page
{
    private $title;
    private $body;
    private $author;
    private $comments;
    private $date;

    public function __construct(string $title, string $body, Author $author)
    {
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->date = new \DateTime();
    }
    public function __clone()
    {
        $this->title = "Copy of ".$this->title;
        $this->author->addToPage($this);
        $this->comments = [];
        $this->date = new \DateTime();
    }
    public function addComment(string $comment)
    {
        $this->comments[] = $comment;
    }
}

class Author
{
    private $name;
    private $pages = [];
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function addToPage(Page $page): void
    {
        $this->pages[] = $page;
    }
}

function program()
{
    $author = new Author("Mubashar Hussain");
    $page = new Page("Tip of the Day", "Keep calm and carry on. ", $author);
    $page->addComment("Nice tip, thanks");
    $draft  = clone $page;
    echo "Dump of the clone. Note that the author is now referencing two objects.<br>";
    echo '<pre>';
    print_r($draft);
}

program();