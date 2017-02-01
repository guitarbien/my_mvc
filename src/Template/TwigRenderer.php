<?php

namespace App\Template;

use Twig_Environment;

class TwigRenderer implements Renderer
{
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($template, $data = []) : string
    {
        return $this->twig->render($template . '.html', $data);
    }
}
