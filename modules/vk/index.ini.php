<?php
/* Index admin page
============================================================ */
//$customers  = $wpdb->get_results( "SELECT * FROM ".$table_name." ORDER BY ID DESC", ARRAY_A );
//var_dump($customers);

?>

<div class="wrap">
  <div class="container-fluid">
    <div class="col-md-12">
      <h1 class="title-page"><?=$TITLEPAGE;?></h1>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-8">
      <h3 class="title-page">Параметры</h3>
      <?php if (!$server_output): ?>
      <div class="alert alert-danger" role="alert">
        <h4>Вы используете <strong>не зарегисрированную</strong> версию плагина.</h4>
        <p>&nbsp;</p>
        <h5>Для использования плагина:</h5>
        <ul>
          <li>1. зарегистрируйтесь на нашем сайте <strong><a href="//bekbot.com/reg">www.bekbot.com</a></strong></li>
          <li>2. ввидите полученный ключ для активации в поле "ключ плагина" и нажмите сохранить</li>
        </ul>
      </div>
      <div class="col-md-6">
        <div class="row">
          <form action method="POST" id="form-regPlugin">
            <div class="form-group">
              <label for="serialNumber">Ваш ключ-лицензия</label>
              <input type="text" class="form-control" name="serialNumber" placeholder="Введите ваш ключ для активации">
            </div>
            <div class="form-group">
              <label for="serialNumber">Нажмите для активации</label><br>
              <button type="submit" name="regPlugin" value="select" class="btn btn-success">Сохранить</button>
            </div>
          </form>

        </div>
      </div><!--//end section reg plugin-->
    <?php endif; ?>
      <div class="clearfix"></div>

      <h3 class="title-page">Настройка подключений</h3>

      <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Главная</a></li>
          <li role="presentation"><a href="#telegram" aria-controls="telegram" role="tab" data-toggle="tab">Telegram</a></li>
          <li role="presentation"><a href="#vk" aria-controls="vk" role="tab" data-toggle="tab">VK</a></li>
          <li role="presentation"><a href="#facebook" aria-controls="facebook" role="tab" data-toggle="tab">Facebook</a></li>
          <li role="presentation"><a href="#instagram" aria-controls="instagram" role="tab" data-toggle="tab">Instagram</a></li>
        </ul>

        <!--Settings-->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <h4 class="title-page">Данные от Bekbot</h4>
            <p>Ответ сервера: <?=$server_output->content->signal;?></p>
            <p>Ключ-лицензия: <?=$server_output->content->key;?></p>
          </div>
          <div role="tabpanel" class="tab-pane" id="telegram">
            <h4 class="title-page">Настройки для Telegram</h4>
            <form action method="POST" id="form-regPlugin">
              <div class="form-group">
                <label for="serialNumber">Ваш серийный номер</label>
                <input type="text" class="form-control" name="serialNumber" placeholder="Введите ваш серийный номер">
              </div>
              <div class="form-group">
                <label for="serialNumber">Нажмите для активации</label><br>
                <button type="submit" name="regPlugin" value="select" class="btn btn-success">Сохранить</button>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="vk">
            <h4 class="title-page">Настройки для VK</h4>

          </div>
          <div role="tabpanel" class="tab-pane" id="facebook">
            <h4 class="title-page">Настройки для Facebook</h4>

          </div>
          <div role="tabpanel" class="tab-pane" id="instagram">
            <h4 class="title-page">Настройки для Instagram</h4>

          </div>
        </div><!--//end tab panes-->
        <!--//end all settings-->
        <hr>
        <p>Версия плагина: <?=BEKBOT_VERSION;?></p>

      </div>


    </div><!--//end .col-md-8-->
    <div class="col-md-4">
      <h3 class="title-page">111</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="//english-svobodno.com/banners/engl300X250.html"></iframe>
      </div>
      <p><a href="//english-svobodno.com" target="_blank">Посетить ресурс</a></p>
    </div>
  </div>
  <div class="clearfix"></div>
</div>