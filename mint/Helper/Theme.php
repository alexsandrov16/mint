<?php
defined('MINT') || die;

namespace Mint\Helper;

/**
 * undocumented class
 */
class Theme
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function __construct(string $tpl)
    {
        $this->tpl = $tpl;
    }

    /**
     * Meta Etiquetas
     *
     * Devuelve las meta-etiquetas a utilizar en la plantilla
     *
     * @return string
     **/
    public function metaTag()
    {
        $title = env('title');
        $description = env('description');
        $charset = env('charset');
        echo <<<HTML
            <meta charset="$charset">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="generator" content="Mint">
            <title>$title</title>
            <meta name="description" content="$description">
            <meta name="keyworks" content="">
            <!--Social-->
            {$this->social($title,$description)}
            <!--Favicon-->
            {$this->favicon()}
            HTML;

        return $this;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    private function social(string $title, string $description = null)
    {
        $url = env('base_url');
        $img = $url . _MEDIA . 'logo.png';
        return <<<HTML
        <meta property="og:title" content="$title">
        <meta property="og:description" content="$description">
        <meta property="og:type" content="website">
        <meta property="og:url" content="$url">
        <meta property="og:image" content="$img">
        HTML;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function favicon()
    {
        //return '<link rel="icon" href="' . env('base_url') . _MEDIA . 'favicon.png" type="image/x-icon">';


        /*$url = env('base_url');
        $d_favicon = "$url/flatpage/admin/assets/img/favicon.ico";
        if (preg_match("/admin/i", $_SERVER['REQUEST_URI'])) {
            return "<link rel='shortcut icon' href='{$d_favicon}' type='image/x-icon'>";
        }*/

        /*$iterator = new DirectoryIterator(ABS_PATH);
        foreach ($iterator as $finfo) {
            if ($finfo->isFile()) {
                foreach (['jpeg', 'jpg', 'png', 'ico'] as $value) {
                    if ($finfo->getExtension() == $value && $finfo->getBasename($value) == 'favicon.') {
                        return "<link rel='shortcut icon' href='{$url}/{$finfo->getBasename()}' type='image/{$value}'>";
                    }
                }
            }
        }
        return "<link rel='shortcut icon' href='{$d_favicon}' type='image/x-icon'>";*/



    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function css(string $style)
    {
        $style = (preg_match("/http/i", $style)) ? $style : env('base_url') . "/content/themes/$this->tpl/css/$style" ;
        echo "<link rel='stylesheet' href='$style'>";

        return $this;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function js(string $script)
    {
        $script = (preg_match("/http/i", $script)) ? $script : env('base_url') . "/content/themes/$this->tpl/js/$script" ;
        echo "<script src='$script'></script>";

        return $this;
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function partial(string $file)
    {
        require_once _THEMES."$this->tpl/partial/$file.php";
        return $this;
    }
}
