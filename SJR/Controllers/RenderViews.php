<?php


namespace SJR\Controllers;


abstract class RenderViews
{

    /**
     * Class to render the page using the initial page and all required variables
     * @param string $page          //  Page initially loaded, usually the Base Index:  BASE_PAGE_INDEX
     * @param object $variables      //  All required variables as an array, must include a component
     */
    public static function renderPage(string $page, object $obj )
    {
        include $page;
    }


}