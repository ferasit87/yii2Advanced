<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';

?>
<div class="site-index">
<div class="wrapper">
  <h1>Test Users</h1>
  <?if ( Yii::$app->user->isGuest){?>
<ul class="tabs clearfix" data-tabgroup="first-tab-group">
  <li><a href="#tab1" class="active">login</a></li>
  <li><a href="#tab2">Signup</a></li>

</ul>
<section id="first-tab-group" class="tabgroup">
  <div id="tab1">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($modelLogIn, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($modelLogIn, 'password')->passwordInput() ?>

                <?= $form->field($modelLogIn, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
          
          Log in via 
                 <?= yii\authclient\widgets\AuthChoice::widget([
           'baseAuthUrl' => ['site/auth'],
           'popupMode' => false,
                    ]) ?>
        </div>
    </div>
    </div>
  <div id="tab2">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($modelSignup, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($modelSignup, 'email') ?>

                <?= $form->field($modelSignup, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
           
            <?php ActiveForm::end(); ?>
              Registration via
              
           <?= yii\authclient\widgets\AuthChoice::widget([
     'baseAuthUrl' => ['site/auth'],
     'popupMode' => false,
              ]) ?>
        </div>
    </div>
  </div>
</section>
<?}?>
</div>
</div>

<script>

   window.fbAsyncInit = function() {
    FB.init({
      appId      : '924432634374050',
      xfbml      : true,
      version    : 'v2.11'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + JSON.stringify(response, null, 4));
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
