<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/exform.css',
        'css/fastorder.css',
        'css/fonts.css',
        // 'css/jquery.bxslider.css',
        'css/mform.css',
        'css/owl.carousel.css',
        'css/owl.transitions.css',
        // 'css/style.min.css',
        'css/stylesheet.min.css',
        'css/eventCalendar.css',
        'css/eventCalendar_theme_responsive.css',
        'css/all.css',
    ];
    public $js = [
        'http://code.jquery.com/jquery.min.js',
        'js/addthis_widget.js',
        'js/bootstrap.js',
        'js/analytics.js',
        // 'js/bundle_ru_RU.js', aaa
        'js/common.min.js',
        'js/cart_js.js',
        'js/exform.js',
        'js/jquery.bxslider.js',
        'js/nouislider.min.js',
        'js/ocfilter.js',
        'js/owl.carousel.min.js',
        // 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
        'js/watch.js',
        //'js/all.min.dilwod.js',aa
        // 'js/all.min.sardor.js',aa
         // 'js/all.min.js',


        // men ulaganlar!!!!
        'js/moment.js',
        'js/jquery.eventCalendar.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
