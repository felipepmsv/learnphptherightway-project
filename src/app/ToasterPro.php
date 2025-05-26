<?php

namespace App;

class ToasterPro extends Toaster
{    
    public function __construct()
    {     
        parent::__construct(); // Call the parent constructor to initialize slices
        
        $this->size = 4;
    }

    public function toastBagel()
    {
        foreach ($this->slices as $i => $slice) {
            echo ($i + 1) . ': Toasting ' . $slice . ' with bagels option' . PHP_EOL;
        }
    }

}