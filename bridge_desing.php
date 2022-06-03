<?php

abstract class Page
{
    protected $renderer;
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function changeRenderer(Renderer $renderer):void
    {
        $this->renderer = $renderer;
    }

    abstract public function view():string;
}

class Simple extends Page
{
    protected $title;
    protected $content;
    public function __construct(Renderer $renderer, string $title, string $content)
    {
        parent::__construct($renderer);
        $this->content = $content;
        $this->title = $title;
    }
    public function view(): string
    {
        // TODO: Implement view() methode
        return $this->renderer->renderParts([
            $this->renderer->renderTitle($this->title),
            $this->renderer->renderTextBlock($this->content)
        ]);
    }
}


interface Renderer
{
    public function renderTitle(string $title):string;
    public function renderTextBlock(string $text):string;
    public function renderImage(string $url):string;
    public function renderLink(string $url, string $title);
    public function renderParts(array $parts):string;
}

class HTMLRenderer implements Renderer
{
    public function renderParts(array $parts): string
    {
        // TODO: Implement renderParts() method.

        return implode("\n", $parts);
    }

    public function renderImage(string $url): string
    {
        // TODO: Implement renderImage() method.
        return "<img src='$url'>";
    }
    public function renderLink(string $url, string $title)
    {
        // TODO: Implement renderLink() method.
        return "<a href='$url'>'$url'</a>".'<br>';
    }
    public function renderTextBlock(string $text): string
    {
        // TODO: Implement renderTextBlock() method.
        return "<div class='text'>'$text'".'<br>';
    }
    public function renderTitle(string $title): string
    {
        // TODO: Implement renderTitle() method.
        return "<h2>'$title'</h2>".'<br>';
    }
}

class JsonRenderer implements Renderer
{
    public function renderParts(array $parts): string
    {
        return "{\n" . implode(",\n", array_filter($parts)) . "\n}";
    }

    public function renderImage(string $url): string
    {
        // TODO: Implement renderImage() method.
        return "<img src='$url'>";
    }
    public function renderLink(string $url, string $title)
    {
        // TODO: Implement renderLink() method.
        return "<a href='$url'>'$url'</a>".'<br>';
    }
    public function renderTextBlock(string $text): string
    {
        // TODO: Implement renderTextBlock() method.
        return "<div class='text'>'$text'".'<br>';
    }
    public function renderTitle(string $title): string
    {
        // TODO: Implement renderTitle() method.
        return "<h2>'$title'</h2>".'<br>';
    }
}



function clientCode(Page $page)
{
    $page->view();
}

$htmlRenderer = new HTMLRenderer();
$jsonRenderer = new JsonRenderer();

$page = new Simple($htmlRenderer, "Home", "Welcome this simple page");
echo 'Html simple PAge'.'<br>';
clientCode($page);

/**
 * The Abstraction can change the linked Implementation at runtime if needed.
 */

$page->changeRenderer($jsonRenderer);
echo "JSON view of a simple content page, rendered with the same client code:\n";
clientCode($page);
echo "\n\n";