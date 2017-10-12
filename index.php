<?php

//单一入口文件 index.php
//载入核心启动类
//如果常量ROOT_PATH定义在这个，则这么写
//define('ROOT_PATH',__DIR__.'/');


include 'framework/core/Framework.class.php';
Framework::run();