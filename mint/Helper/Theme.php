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
        return '<link rel="icon" href="' . env('base_url') . _MEDIA . 'favicon.png" type="image/x-icon">';
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
    public function css(string $ss)
    {
        return $this;
    }
}
