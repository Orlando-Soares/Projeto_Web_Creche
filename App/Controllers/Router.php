<?php

namespace Controllers;
use Views\html_build;

class Router
{
    private $request_uri = "";
    private $request_method = "";
    private $query_string = "";
    private $root_directory = "/Projeto_Web_Creche/";

    public function router_verify($request, $content)
    {
        $this->request_uri = parse_url($request["REQUEST_URI"])['path'];
        $this->request_method = $request["REQUEST_METHOD"];
        $this->query_string = $request["QUERY_STRING"];

        if($this->request_method === "GET") {

            if($this->request_uri === $this->root_directory) {                
                $html = new html_build("HOME");
                return $html->home();          
            } 
            
            if($this->request_uri === $this->root_directory ."login") {
                $html = new html_build("LOGIN");
                return $html->login();
            }

            $html = new html_build("PÁGINA NÃO ENCONTRADA");
            return $html->page_not_found();
        }
        
        
        return "The requested route does not exist!";
        
    }
}