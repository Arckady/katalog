<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Меню</li>
            <!-- Optionally, you can add icons to the links -->
            
            <li><a href="<?= \yii\helpers\Url::to(['book/index']) ?>"><i class="fa fa-book"></i> <span>Книги</span></a></li>
            <li><a href="<?= \yii\helpers\Url::to(['category/index']) ?>"><i class="fa fa-th-large"></i> <span>Категории</span></a></li>
            <li><a href="<?= \yii\helpers\Url::to(['feedback/index']) ?>"><i class="fa fa-envelope"></i> <span>Обращения</span></a></li>
            <li><a href="<?= \yii\helpers\Url::to(['options/index']) ?>"><i class="fa fa-cogs"></i> <span>Настройки</span></a></li>
            
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>