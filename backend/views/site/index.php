<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Html;

?>
<div class="site-index">
    <div class="wrapper">
      <h1>Users Mangement</h1>
     <table>
      <thead>
        <tr>
          <th width="50">Login</th>
          <th width="150">Email</th>
          <th width="50">-</th>
          <th width="50">-</th>
        </tr>
      </thead>
      <tbody>
      <?foreach ($users as $user) {?>
        <tr>
          <td><?=$user['login']?></td>
          <td><?=$user['email']?></td>
          <td>
            <a class="button info" href="/index.php?r=site/edit&id=<?=$user['id']?>">Edit</a>
          </td>
          <td>
            <a class="button alert" href="/index.php?r=site/delete&id=<?=$user['id']?>">Delete</a>
          </td>
        </tr>
        <?}?>
      </tbody>
    </table>
    </div>
</div>
