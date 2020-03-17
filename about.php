<?php

    include 'header.php';
    include 'banner.php';

    // 内容
    $about = select_all('about');
    // pre($about);



    include 'views/about.html';
    include 'footer.php';