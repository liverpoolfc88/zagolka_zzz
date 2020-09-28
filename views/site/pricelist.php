<?php
use app\models\ShopcartOrders;
use app\models\Lang;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Lang::t('pricelist');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>



<h1><?=$this->title?></h1>

<table>
  <tr>
    <th><?=Lang::t("Product Name")?></th>
    <th><?=Lang::t("Pieces")?></th>
    <th><?=Lang::t("Price")?></th>
    <th><?=Lang::t("Sale")?></th>
  </tr>
  
  <?
  foreach ($items as $value): ?>
  <tr>
    <td><?=$value->title?></td>
    <td>
      <?php
                                        if ($value->pieces==NULL){?>
                                            <b>                                                
                                            <?= Lang::t('dona') ?>
                                            </b>
                                        <?}else {?>
                                            <b>                                                
                                            <?= Lang::t('pachkada') ?>
                                            </b>
                                            <br>
                                        <?=$value->pieces?>
                                        <?= Lang::t('  ta bor') ?>
                                            <?}?>
    </td>
    <td><?=$value->price?></td>
    <td><?=$value->sale?></td>
  </tr>
<? endforeach; ?>




  <!-- <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr> -->
</table>


