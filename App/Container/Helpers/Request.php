<?php
namespace App\Container\Helpers;

class Request {
    
    private $vars = [];
    public $post = [];
    public $get = [];
    
    public function __construct($vars){
        $this->vars = $vars;
        
        if(isset($vars['post']['_token'])) unset($vars['post']['_token']);

        $this->post = (object) $vars['post'];
        $this->get = (object) $vars['get'];
    }
    
    /**
     * get the current url you are on
     *
     * @method url
     *
     * @author [Agne Ødegaard]
     *
     * @return [string] [url]
     */
    public function url(){
        return $this->vars['without_vars'];
    }
    
    /**
     * get the current url you are on with the appended get request vars
     *
     * @method get_url
     *
     * @author [Agne Ødegaard]
     *
     * @return [string]  [url/vars]
     */
    public function get_url(){
        return '/'.$this->vars['url'];
    }
    
    /**
     * get the breadcrubs trail, in html
     *
     * @method get_beardcrubs
     *
     * @author [Agne Ødegaard]
     *
     * @return [string]         [html]
     */
    public function get_beardcrubs(){
        $url = explode('/', $this->url());
        array_shift($url);
        $concat = '';
        foreach ($url as $key => $value) {
            $url[$key] = "<li><a href='/$concat$value'>$value</a></li>";
            $concat .= $value.'/';
        }
        
        return '<ul class="breadcrubs">'.implode('<li> > </li>', $url).'</ul>';
    }
    
    /**
     * get the current method you are calling the page with.
     *
     * @method method
     *
     * @author [Agne Ødegaard]
     *
     * @return [string] [post, put, get, patch, delete, error]
     */
    public function method(){
        return isset($this->vars['post']['_method']) ? strtolower($this->vars['post']['_method']) : 'get';
    }
    
}