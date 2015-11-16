<?php
/**
 * Class for crawling urls from a website link
 */

class Crawler
{
    /**
     *
     * @var array
     */

    private static $links = [];

    /**
     * 
     * @param string $url
     * @return \self
     */
    public static function url($url)
    {
       
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_HEADER, 0);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 25);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        $regexp = "<a\s[^>]*href=(\"??)([^\">]*?)\\1[^>]*>(.*)<\/a>";
        preg_match_all("/$regexp/siU", $data, $matches);

        self::$links = $matches[2];
        
        return new self;
    }
    
    /**
     * 
     * print url
     */
    public static function getUrl()
    {
      return self::$links;  
    }

}
