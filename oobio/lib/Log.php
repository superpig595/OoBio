<?php
/**
 * Oobio - 简单、高效的PHP微框架
 * Copyright (c) 2018 Oobio . All rights reserved.
 * Author: 勇敢的小笨羊
 * Github: https://github.com/superpig595/OoBio
 * Weibo: http://weibo.com/xuzuxing
 *
 */

// Oobio 日志类
namespace oobio\lib;
use oobio\lib\drive\log as logdrive;

class Log
{

    /**
     * 日志存储驱动
     * @var
     */
    public static $drive;


    /**
     * 初始化
     * @throws \Exception
     */
    public static function init()
    {
        //读取配置储存方式
        $drive=conf::get('DRIVE','log');
        if ($drive == 'file'){
            self::$drive = new logdrive\file();
        }else if ($drive ==  'mysql'){
            self::$drive = new logdrive\mysql();
        }else{
            throw new \Exception('日志驱动不存在');
        }
    }

    /**
     * * 记录调试信息
     * @access public
     * @param $name
     * @param string $file
     */
    public static function record($name, $file = 'log')
    {
        self::$drive->save($name,$file);
    }

}