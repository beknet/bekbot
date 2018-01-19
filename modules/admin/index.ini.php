<div class="wrap">
  <div class="container-fluid">
    <div class="col-md-12">
      <h1 class="title-page"><?=$TITLEPAGE;?></h1>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-8">
      <h3 class="title-page">Параметры</h3>
      <?php if(status($server_output) !== 'OK'): ?>
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
      <?php else: ?>
        <div class="alert alert-success" role="alert">
          <p>Благодарим Вас за получение лицензии.</p>
          <p>По всем вопросам вы можете обратиться в службу поддержке сервиса, <strong>контакты на нашем сайте: <a href="//bekbot.com/sup">www.bekbot.com</a></strong></p>
        </div>
      <?php endif; ?>
      <div class="clearfix"></div>

      <h3 class="title-page">Настройка подключений</h3>

      <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Главная</a></li>
          <li role="presentation"><a href="#telegram" aria-controls="telegram" role="tab" data-toggle="tab">Telegram</a></li>
          <li role="presentation"><a href="#vk" aria-controls="vk" role="tab" data-toggle="tab">VK</a></li>
          <li role="presentation"><a href="#type_post" aria-controls="type_post" role="tab" data-toggle="tab">Типы записей</a></li>
          <!-- <li role="presentation"><a href="#instagram" aria-controls="instagram" role="tab" data-toggle="tab">Instagram</a></li> -->
        </ul>

        <!--Settings-->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <h4 class="title-page">Данные от Bekbot</h4>
            <p>Ответ сервера: <?=status($server_output);?></p>
            <p>Номер договора: <?=idacc($server_output);?></p>
            <p>Ключ-лицензия: <?=lickey($server_output);?></p>
          </div>
          <div role="tabpanel" class="tab-pane" id="telegram">
            <h4 class="title-page">Настройки для Telegram</h4>
            <p>До сих пор пользуетесь e-mail рассылкой? По статистике более 69% из существующих сервисов не справляются со своей задачей. С оставшимися же вы страдаете от того, что отправляемые письма блокируются на стороне почтовых серверов, отправляются в спам, люди все меньше и меньше открывают ваши письма... Начните использовать телеграм, в соответствие с текущей статистикой каналы и группы телеграм работаю во много раз эффективнее устаревшей e-mail рассылки. Подписчики открыают и читают ваши сообщения на канале и в группах в 97% случаях, завести себе телеграмм проще простого, и вы можете быть уверенны на все 99,9%, что ваше сообщение будет получено подписчиком!</p>
            <form action method="POST" id="form-dataTelegram">
              <div class="form-group">
                <label for="tgGroup">Идентификатор группы/канала (https://t.me/<code>bekkercoil</code> -> @<code>bekkercoil</code>)</label>
                <input type="text" class="form-control" name="tgGroup" placeholder="Введите идентификатор группы/канала" value="<?=tlgroup($datadb_output);?>">
              </div>
              <div class="form-group">
                <button type="submit" name="dataTelegram" value="select" class="btn btn-success">Сохранить</button>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="vk">
            <h4 class="title-page">Настройки для VK</h4>
            <p>Написали пост в своем блоге и тут же бежите делать репост в ручную в свою группу в Вконтакте? Хватит! Вводи данные и экономь свое время с авторепостом. Плагин репостит ваши опубликованные посты из блога в группу, вы так же можете планирововать дату и время публикации, а наш плагин выполнит перепост в группу в формате анонса с картинкой, если выбрана и ссылкой на полную версию поста на вашем сайте.</p>
            <form action method="POST" id="form-dataVK">
              <div class="form-group">
                <label for="vkGroup">Идентификатор группы (ID)</label>
                <input type="text" class="form-control" name="vkGroup" placeholder="Введите идентификатор группы" value="<?=vkgroup($datadb_output);?>">
              </div>
              <div class="form-group">
                <button type="submit" name="dataVK" value="select" class="btn btn-success">Сохранить</button>
              </div>
            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="type_post">
            <h4 class="title-page">Настройки типов записей</h4>
            <p>Выбирите типы записей которые вы хотите, чтобы автоматически постились в ваши соц.сети и мессенджеры после публикации на сайте.</p>
            <form action method="POST" id="form-dataTypePosts">
            <?php
              $my_typesps = unserialize($datadb_output->datatypes);
              $post_types = get_post_types('','names');
              foreach( $post_types as $post_type ):
                if( !in_array( $post_type, ARR_EXIST_TYPES ) ):
                  $cheked_t = in_array($post_type, $my_typesps);
                  if($cheked_t != false){ $cheked_t = 'checked'; }else{ $cheked_t = ''; }
                  //var_dump($datadb_output->datatypes);
            ?>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="type_posts[]" <?=$cheked_t;?> value="<?=$post_type;?>"> <?=$post_type;?>
                </label>
              </div>
            <?php
                endif;
              endforeach;
            ?>
              <div class="form-group">
                <button type="submit" name="dataTypePosts" value="select" class="btn btn-success">Сохранить</button>
              </div>
            </form>
          </div>
          <!-- <div role="tabpanel" class="tab-pane" id="instagram">
            <h4 class="title-page">Настройки для Instagram</h4>

          </div> -->
        </div><!--//end tab panes-->
        <!--//end all settings-->
        <hr>
        <p>Версия плагина: <?=BEKBOT_VERSION;?></p>

      </div>


    </div><!--//end .col-md-8-->
    <div class="col-md-4">
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="//english-svobodno.com/banners/engsvobodno/sidebar-engsvobodno210X250.html"></iframe>
      </div>
      <p><a href="//english-svobodno.com" target="_blank">Посетить ресурс</a></p>
    </div>
  </div>
  <div class="clearfix"></div>
</div>