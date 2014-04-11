<?php

function add_meta_title ($string)
{
    $CI =& get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_add($uri){
    return anchor(
        $uri, 
        '<button class="btn btn-small btn-primary" type="button"><i class="icon-plusb icon-white"></i> Add</button>',
        'id="addb"'
    );
}

function btn_edit ($uri)
{
    return anchor(
        $uri, 
        '<button class="btn btn-mini btn-primary" type="button"><i class="icon-editb icon-white"></i> Edit</button>'
    );
}

function btn_delete ($uri)
{
    return anchor(
        $uri, 
        '<button class="btn btn-mini btn-danger btn-primary" type="button"><i class="icon-remove icon-white"></i> Delete</button>', 
        array('onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
    ));
}

function article_link($article){
    return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles){
    $string = '<ul>';
    foreach ($articles as $article) {
        $url = article_link($article);
        $string .= '<li>';
        $string .= '<h8>' . anchor($url, e($article->title)) .  ' ›</h8>';
        $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
        $string .= '</li>';
    }
    $string .= '</ul>';
    return $string;
}

function get_excerpt($article, $numwords = 50){
    $string = '';
    $url = article_link($article);
    $string .= '<h7>' . anchor($url, e($article->title)) .  '</h7>';
    $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
    $string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
    $string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
    return $string;
}

function limit_to_numwords($string, $numwords){
    $excerpt = explode(' ', $string, $numwords + 1);
    if (count($excerpt) >= $numwords) {
        array_pop($excerpt);
    }
    $excerpt = implode(' ', $excerpt);
    return $excerpt;
}

function e($string){
    return htmlentities($string);
}

function get_menu ($array, $child = FALSE)
{
    $CI =& get_instance();
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

        foreach ($array as $item) {

            $active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
                $str .= '<b class="caret"></b></a>' . PHP_EOL;
                $str .= get_menu($item['children'], TRUE);
            }
            else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ul>' . PHP_EOL;
    }
	
    return $str;
}

function get_menu_app ($array, $child = FALSE)
{
    $CI =& get_instance();
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
		
        foreach ($array as $item) {
            
            $active = 'app/'.$CI->uri->segment(2) == $item['link'] ? TRUE : FALSE;
            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['link'])) . '">' . e($item['nama_menu']);
                $str .= '<b class="caret"></b></a>' . PHP_EOL;
                $str .= get_menu_app($item['children'], TRUE);
            }
            else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="' . site_url($item['link']) . '">' . e($item['nama_menu']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ul>' . PHP_EOL;
    }
	
    return $str;
}

function get_left_menu_app ($array, $child = FALSE)
{
    $CI =& get_instance();
    $str = '';

    if (count($array)) {   
        foreach ($array as $item) {
            if($item['level'] == 1){
                // get opened menu
                $selected_menu = ""; $selected = "";
                foreach($item['children'] as $sub_item){
                    if('app/'.$CI->uri->segment(2) == $sub_item['slug']){
                        $selected_menu = $item['nama_menu'];
                    }
                }
                
                if($item['nama_menu'] == $selected_menu) $selected = 'selected="true"';
                $str .= '<div title="'.$item['nama_menu'].'" data-options="height:10" '.$selected.' style="overflow:auto;padding:5px 0px;"> 
                         <ul class="easyui-tree">'; 
                foreach($item['children'] as $sub_item){
                    if($sub_item['id_parent'] == $item['id_menu']){
                        $str .= '<li>
                                    
								<a href="'.site_url($sub_item['link']).'" plain="true">'
									.$sub_item['nama_menu'].
								'</a>
									
							 </li>';
                    }
                }
                $str .= '</ul></div>'. PHP_EOL;
            }
        }
    }
    return $str;
}

//function set_form_from_array($rules){
//    $string = '<ul>';
//    foreach ($articles as $article) {
//        $url = article_link($article);
//        $string .= '<li>';
//        $string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
//        $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
//        $string .= '</li>';
//    }
//    $string .= '</ul>';
//    return $string;
//}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}