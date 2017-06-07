<?php declare(strict_types = 1);

/*
namespace microphp\Controllers;

class Homepage
{
    public function show()
    {
        echo 'Hello World from HomePage';
    }
}
*/
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
        $this->response->setContent('Hello World from show method');
    }
}
*/
/*
namespace microphp\Controllers;

use Http\Request;
use Http\Response;

class Homepage
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function show()
    {
        $content = '<h1>Hello World</h1>';
        $content .= 'Hello ' . $this->request->getParameter('name', 'stranger');
        $this->response->setContent($content);
    }
}
*/
namespace microphp\Controllers;

use Http\Request;
use Http\Response;
//use microphp\Template\Renderer;
use microphp\Template\FrontendRenderer;

class Homepage
{
    private $request;
    private $response;
    private $renderer;

    public function __construct(
        Request $request,
        Response $response,
        //Renderer $renderer
        FrontendRenderer $renderer
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
    }

    public function show()
    {
        /*$data = [
            'name' => $this->request->getParameter('name', 'stranger'),
        ];*/
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
            //'menuItems' => [['href' => '/', 'text' => 'Homepage']],
        ];
        $html = $this->renderer->render('Homepage', $data);
        $this->response->setContent($html);
    }
}
