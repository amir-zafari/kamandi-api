<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ApiCard extends Component
{
    public $method;
    public $url;
    public $title;
    public $desc;
    public $response;
    public $errors;
    public $id;

    public function __construct($method, $url, $title, $desc, $response = null, $errors = null, $id = null)
    {
        $this->method = $method;
        $this->url = $url;
        $this->title = $title;
        $this->desc = $desc;
        $this->response = $response;
        $this->errors = $errors;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.api-card');
    }
}
