 <?

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\maxpirali\Menu;
use app\models\Lang;

 ?>
 <style>
    .mainmenubtn {
    /*background-color: red;*/
    color: black;
    border: none;
    cursor: pointer;
    padding: 5px;
    margin-top: 5px;
    margin-left: 5px;
    }
    .mainmenubtn a {
    /*background+-color: red;*/
    color: black;
    }
    .dropdown {
    position: relative;
    display: inline-block;
    }
    .dropdown-child {
    display: none;
    /*background-color: black;*/
    min-width: 200px;
    }
    .dropdown-child a {
    color: black;
    padding: 10px;
    text-decoration: none;
    display: block;
    margin-left: 30px;
    }
    .dropdown:hover .dropdown-child {
    display: block;
    }
 </style>
 <div id="notification"></div>
 <div class="module-categories">
    <ul>
    	<?php PrintMenuLeft(Menu::menus()); ?>
    </ul>
    <div style="margin-top: 30px" id="eventCalendar"></div>
  
 </div>
<?php function PrintMenuLeft($menu){ ?>
    <? foreach ($menu as $value) { ?>
        <li><a href="<?=Url::to(['site/index', 'slug' => $value['slug']])?>" class="parent-a"><?=$value['title']?></a>
            <? if ($value['children']) { ?>
                <!-- <ul> -->
                    <? //PrintMenuLeft($value['children']); ?>
                <!-- </ul> -->
            <?} ?>
        </li>
        <? }  
    }

    
?>
<!--<script src="http://code.jquery.com/jquery.min.js"></script>-->
<script type="text/javascript">
    $(function(){
        var data=[
            {
                "date": "1314579600000", "type": "meeting", "title": "Test Last Year",
                "description": "Lorem Ipsum dolor set",
                "url": "http://www.event3.com/"
            },
            {
                "date": "1377738000000", "type": "meeting",
                "title": "Test Next Year", "description": "Lorem Ipsum dolor set",
                "url": "http://www.event3.com/"
            },
        ];
        $('#eventCalendar').eventCalendar({
            jsonData:data
        });
    }
);
</script>