<?php

namespace App\Requests\GET;

class IndexPage {

    public function handle() {
        echo message('Developed by Taha Shieenavaz');
    }

}