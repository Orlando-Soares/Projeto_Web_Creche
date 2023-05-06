<?php
namespace Views;

class html_build
{
    private $html;

    function __construct($title) 
    {
        $this->html = $this->get_file_content("../../Public/Model_HTML.php");
        $this->html = str_replace("<<title>>", $title, $this->html);
    }

    public function home() 
    {
        return $this->generate_html("Home");        
    }    

    public function login() 
    {
        return $this->generate_html("Login");  
    }

    public function page_not_found() 
    {
        return $this->generate_html("Page_not_found");
    }

    private function generate_html($file_name)
    {        
        $html_file_content = $this->get_file_content("../../Public/" . $file_name . "/" . $file_name . ".php");
        $this->html = str_replace("  <<body>>", $html_file_content, $this->html);
        $links_css = $this->fetch_css("../../Public/" . $file_name . "/CSS");
        $this->html = str_replace("<<link_css>>", $links_css, $this->html);
        $links_javascript = $this->fetch_javascript("../../Public/" . $file_name . "/JavaScript");
        $this->html = str_replace("<<link_script>>", $links_javascript, $this->html);
        return $this->html;
    }

    private function get_file_content($name) 
    {
        $file_content = file_get_contents($this->get_file_directory($name));
        return $file_content;
    }

    private function get_file_directory($name) 
    {
        $file_directory = __DIR__ . "/" . $name;
        $file_directory = str_replace("\Class", "", $file_directory);
        $file_directory = str_replace("\\", "/", $file_directory);
        return $file_directory;
    }

    private function fetch_css($folder) 
    {        
        $tag = [
            "tag_ini" => "<link rel=\"stylesheet\" type=\"text/css\" href=\"", 
            "tag_fin" => "\" />"
        ];
        return $this->generate_links($tag, $folder);        
    }

    private function fetch_javascript($folder) 
    {        
        $tag = [
            "tag_ini" => "<script type=\"text/javascript\" src=\"", 
            "tag_fin" => "\"></script>"
        ];
        return $this->generate_links($tag, $folder);        
    }

    private function generate_links($tag, $folder) 
    {
        $directory = $this->get_file_directory($folder);
        $array_files_name = scandir($directory);        
        $return_links = "";
        foreach ($array_files_name as $file_name) {
            if($file_name !== "." && $file_name !== "..") {
                if($return_links !== "") { $return_links = $return_links . "\n    "; }
                $folder = str_replace("../../", "./", $folder);
                $return_links = $return_links . $tag["tag_ini"] . $folder . "/" . $file_name . $tag["tag_fin"];
            }
        }
        return $return_links;        
    }

}