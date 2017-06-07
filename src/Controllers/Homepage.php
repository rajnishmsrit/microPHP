<?php declare(strict_types = 1);

namespace microphp\Controllers;

class Homepage
{
    public function show()
    {
        echo 'Hello World from HomePage';
    }
}
/*

namespace microphp\Controllers;

use Http\Response;

class Homepage
{
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function show()
    {
        $this->response->setContent('Hello World');
    }
}
*/
