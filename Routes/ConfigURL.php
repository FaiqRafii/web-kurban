<?php

namespace Routes\ConfigURL;

class URL
{
    public string $link = '';
    public string $filePath = '';

    function getUrl()
    {
        $this->link = $_SERVER['REQUEST_URI'];
    }

    function getPath($link)
    {
        $mirrored = '';
        $straight = '';
        for ($i = strlen($this->link) - 1; $i > 0; $i--) {
            $mirrored .= $this->link[$i];
            if ($this->link[$i] == '/') {
                break;
            }
        }

        for ($i = strlen($mirrored) - 1; $i >= 0; $i--) {
            $straight .= $mirrored[$i];
        }

        $this->filePath = basename($straight);
        return $this->filePath;
    }

    function openPage($path)
    {
        if(!$path==''){

            include 'Pages/' . $path . '.php';
        }
    }
    
}
