<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;

class ImageController extends Controller
{
	public function index()
	{
        try {
            $T1 = 'PHP';
            $T2 = 'JS';
            $T3 = 'SQL';
            $T4 = 'SO';
            $t5 = 'LINUX';

            $this->status = parent::SUCCESS;
            $this->message = '';
            $images = [
                [
                    'image' => 'https://ewm.swiss/application/files/9115/9228/7517/shutterstock_1119270824_2.jpg',
                    'type' => $T1
                ],
                [
                    'image' => 'https://www.macklus.net/wp-content/uploads/2019/11/yii-framework.png',
                    'type' => $T1
                ],
                [
                    'image' => 'https://www.diligent.es/wp-content/uploads/2018/05/Que-es-el-Framework-Symfony-php-marketplaces.jpg',
                    'type' => $T1
                ],
                [
                    'image' => 'https://blog.phalcon.io/assets/files/2022-08-18-phalcon-5.0.0-rc.4.png',
                    'type' => $T1
                ],
                [
                    'image' => 'https://ubublog.com/wp-content/uploads/2016/04/slim-logo.png',
                    'type' => $T1
                ],
                [
                    'image' => 'https://aws1.discourse-cdn.com/sonarsource/uploads/sonarcommunity/original/3X/8/0/8093068d130895560499e488d9f58e71cd07076f.png',
                    'type' => $T1
                ]
            ];

            $this->data = $images;

            return $this->asJson();
        } catch (Throwable $e) {
            return $this->baseException($e);
        }
	}
}
