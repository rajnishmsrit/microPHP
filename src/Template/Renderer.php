<?php declare(strict_types = 1);

namespace microphp\Template;

interface Renderer
{
    public function render($template, $data = []) : string;
}
