<?php

namespace App\Controllers;

class MainController extends CoreController
{
    public function home()
    {
        $this->show('main/home');
    }

    public function contact()
    {
        $this->show('main/contact');
    }

    public function legal()
    {
        $this->show('main/legal-notices');
    }
}