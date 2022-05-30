<?php
//Problem#1
//A web application can support different rendering engines at the same time, but only
//if its classes are independent of the concrete classes of rendering engines. Hence, the application’s objects
//must communicate with template objects only via their abstract interfaces. Your code shouldn’t create the template
//objects directly, but delegate their creation to special factory objects. Finally, your code shouldn’t depend on the
//factory objects either but, instead, should work with them via the abstract factory interface.
//
//As a result, you will be able to provide the app with the factory object that corresponds to one of the rendering engines.
//All templates, created in the app, will be created by that factory and their type will match the type of the factory.
//If you decide to change the rendering engine, you’ll be able to pass a new factory to the client code, without breaking any existing code.

namespace RefactoringGuru\AbstractFactory\RealWorld;

interface TemplateFactory
{
    public function createTitleTemplate():TitleTemplate;
    public function createPageTemplate():PageTemplate;
    public function getRenderer():TemplateRenderer;
}


class TwigTemplateFactory implements TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate
    {
        // TODO: Implement createTitleTemplate() method.
        return new TwigTitleTemplate();
    }
    public function createPageTemplate(): PageTemplate
    {
        // TODO: Implement createPageTemplate() method.
        return new TwigPageTemplate($this->createTitleTemplate());
    }

    public function getRenderer(): TemplateRenderer
    {
        // TODO: Implement getRenderer() method.
        return new TwigRenderer();
    }
}

interface TitleTemplate
{
    public function getTemplateString(): string;
}
interface PageTemplate
{
    public function getTemplateString():string;
}
interface TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string;
}


class TwigTitleTemplate implements TitleTemplate
{
    public function getTemplateString(): string
    {
        // TODO: Implement getTemplateString() method.
        return "<h2>{{ title }}</h2>";
    }
}

abstract class BasePageTemplate implements PageTemplate
{
    protected $titleTemplate;
    public function __construct(TitleTemplate $titleTemplate)
    {
        $this->titleTemplate = $titleTemplate;
    }
}
class TwigPageTemplate extends BasePageTemplate
{
    public function getTemplateString(): string
    {
        // TODO: Implement getTemplateString() method.
        $renderedTitle = $this->titleTemplate->getTemplateString();
        return <<<HTML
        <div class="page">
            $renderedTitle
            <article class="content">{{ content }}</article>
        </div>
        HTML;
    }
}

class TwigRenderer implements TemplateRenderer
{
    public function render(string $templateString, array $arguments = []): string
    {
        // TODO: Implement render() method.
        return \Twig::render($templateString, $arguments);
    }
}


class Page
{
    public $title;
    public $content;

    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }
    public function render(TemplateFactory $factory): string
    {
        $pageTemplate = $factory->createPageTemplate();
        $renderer = $factory->getRenderer();

        return $renderer->render($pageTemplate->getTemplateString(), ['title'=>$this->title, 'content'=>$this->content]);
    }
}

$page = new Page('Sample Page', 'This is the body');
echo "Testing Actual rendering with the PHPTemplate Factor:".'<br>';

echo $page->render(new TwigTemplateFactory());


