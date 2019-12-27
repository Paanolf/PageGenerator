<?php

/**
 * Class Page
 * This class generates html pages, and automatically include bootstrap, jquery & fontawesome via their CDN
 * You can include or not (via $defaultlib, a constructor parameter) BootStrap, JQuery and FontAwesome via their CDN.
 * Versions used :
 *      - Bootstrap : 4.4.1
 *      - JQuery : 3.4.1
 *      - FontAwesome : 5.8.1
 *
 * @author PandarkMeow
 * @version 1.0
 * @licence GNU GPL v.3.O
 */

class Page {

    /******************************************
     *************** Class var ****************
     ******************************************/
    private $charset; // characters encoding
    private $title; // title of the html page
    private $header; // header of the page
    private $content; // content of the page
    private $scripts; // scripts urls (array)
    private $stylesheets; //stylesheets urls (array)
    private $footer; // footer of the page
    private $faviconPath; // Path to the favicon
    private $cdnStylesheet;
    private $cdnScript;
    private $cdnJQuery = '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>';
    private $cdnCSSBootstrap = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
    private $cdnJSBootstrap = '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>';
    private $cdnFontAwesome = '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">';

    /**
     * Page constructor.
     * @param $title - title of the html page
     * @param string $charset - the character encoding (UTF-8 by default)
     * @param string $favicon - the website's favicon
     * @param bool $defaultlib - set to false if you don't want the defaults libraries (Bootstrap, Jquery, Font-Awesome).
     */
    public function __construct($title, $charset = "UTF-8", $favicon = "", $defaultlib = true) {
        $this->charset = $charset;
        $this->title = $title;
        $this->header = "";
        $this->content = "";
        $this->footer = "";
        $this->scripts = array();
        $this->stylesheets = array();
        $this->faviconPath = $favicon;
        $this->cdnStylesheet = "";
        $this->cdnScript = "";
        if(!$defaultlib) {
            $this->cdnCSSBootstrap = $this->cdnFontAwesome = $this->cdnJQuery = $this->cdnJSBootstrap = '';
        }
    }

    /*********************************************
     ********************* GETTERS ***************
     ********************************************/
    public function getCharset() {
        return $this->charset;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getHeader() {
        return $this->header;
    }

    public function getContent() {
        return $this->content;
    }

    public function getScripts() {
        return $this->scripts;
    }

    public function getStylesheets() {
        return $this->stylesheets;
    }

    public function getFooter() {
        return $this->footer;
    }

    public function getFaviconPath() {
        return $this->faviconPath;
    }

    public function getCDNStylesheet() {
        return $this->cdnStylesheet;
    }

    public function getCDNScript() {
        return $this->cdnScript;
    }

    /**
     * Add some HTML to the body header of the page
     * @param $html - the html to add
     */
    public function addHeader($html) {
        $this->header .= $html;
    }

    /**
     * Add some HTML to the body, after the header
     * @param $html - the html to add
     */
    public function addContent($html) {
        $this->content .= $html;
    }

    /**
     * Add some HTML to the footer
     * @param $html - the html to add
     */
    public function addFooter($html) {
        $this->footer .= $html;
    }

    /**
     * Add a script
     * @param $html - the html to add
     */
    public function addScript($scriptPath) {
        $this->scripts[] = $scriptPath;
    }

    /**
     * Add a stylesheet
     * @param $html - the html to add
     */
    public function addStylesheet($stylesheetPath) {
        $this->stylesheets[] = $stylesheetPath;
    }

    /**
     * Allow the user to add a stylesheet library located on a cdn (simply copy the markup)
     * @param $html - the html to add
     */
    public function addCDNStylesheet($html) {
        $this->cdnStylesheet .= $html;
    }

    /**
     * Allow the user to add a script library located on a cdn (simply copy the markup)
     * @param $html - the html to add
     */
    public function addCDNScript($html) {
        $this->cdnScript .= $html;
    }
    /**
     * Create the page
     *
     * @return string - the page
     */
    public function generatePage() {
        $html =<<<HTML
            <!doctype html>
            <html>
                <head>
                    <meta charset="{$this->charset}" />
                    {$this->cdnCSSBootstrap}
                    {$this->cdnFontAwesome}
                    {$this->cdnStylesheet}
HTML;
        for($i = 0; $i < count($this->stylesheets); $i++) {
            $html .=<<<HTML
                    <link rel="stylesheet" href="{$this->stylesheets[$i]}" /> 
HTML;
        }
        $html .=<<<HTML
                    <link rel="icon" href="{$this->faviconPath}" />
                </head>
                
                <body>
HTML;
        if($this->header != "") {
            $html .=<<<HTML
                    <header>
                        {$this->header}
                    </header>
HTML;
        }
        $html .= <<<HTML
                    {$this->content}
HTML;
        if($this->footer != "") {
            $html .=<<<HTML
                    <footer class="footer">
                        {$this->footer}
                    </footer>
HTML;
        }
        $html .=<<<HTML
                    {$this->cdnJQuery}
                    {$this->cdnJSBootstrap}
                    {$this->cdnScript}
HTML;

        for($i = 0; $i < count($this->scripts); $i++) {
            $html .=<<<HTML
                    <script src="{$this->scripts[$i]}"></script>
HTML;
        }
        $html .=<<<HTML
                </body>
            </html>
HTML;

        return $html;
    }

}