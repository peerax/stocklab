<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>

    <body>

        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'หน้าหลัก', 'url' => array('/site/index')),
                        array(
                            'label' => 'ตั้งค่า',
                            'items' => array(
                                array('label' => 'ตั้งค่าหน่วยนับ',
                                    'url' => array('/AddUnit/index')),
                                array('label' => 'ตั้งค่าบริษัท',
                                    'url' => array('/AddCom/index')),
                                array('label' => 'ตั้งค่าวัสดุ',
                                    'url' => array('/AddItem/index')),
                            ),
                        ),
                        array(
                            'label' => 'บันทึกรับ-เบิก',
                            'items' => array(
                                array('label' => 'รับวัสดุ',
                                    'url' => array('/RecItem/index')),
                                array('label' => 'เบิกวัสดุ',
                                    'url' => array('/PayItem/index')),
                            ),
                        ),
                        array(
                            'label' => 'รายงาน',
                            'items' => array(
                                array('label' => 'รายงานบันทึกรับวัสดุ',
                                    'url' => array('/Report/recpay')),
                                array('label' => 'รายงานบันทึกจ่ายวัสดุ',
                                    'url' => array('/Report/reppay')),
                                array('label' => 'รายงานวัสดุในคงเหลือคลัง',
                                    'url' => array('/Report/repstock')),
                            )
                        ),
                        array('label' => 'เกี่ยวกับโปรแกรม', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'เข้าระบบ', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'ออกจากระบบ (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ),
            ),
        ));
        ?>
        <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Sign In</button>
                </form>

        <div class="container" id="page">

            <?php /* if(isset($this->breadcrumbs)):?>
              <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
              'links'=>$this->breadcrumbs,
              ));
             *  endif
             */ ?>


            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer" align="center">
                ลิขสิทธิ์ &copy; <?php echo date('Y'); ?> <a href="http://www.kaimintsoft.com">Kaimintsoft.</a><br/>
                สงวนลิขสิทธิ์.<br/> รุ่นทดสอบ ห้ามจำหน่าย<br/>
                        <!-- Histats.com  START  (standard)-->
        <script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
        <a href="http://www.histats.com" target="_blank" title="hit counter html code" ><script  type="text/javascript" >
            try {
                Histats.start(1, 2422133, 4, 1044, 200, 30, "00001000");
                Histats.track_hits();
            } catch (err) {
            }
            ;
            </script></a>
        <noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?2422133&101" alt="hit counter html code" border="0"></a></noscript>
        <!-- Histats.com  END  -->
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
