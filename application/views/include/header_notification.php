<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-notification">
    <?php if (my_total_unseen_notification() != 0) { ?>
        <span id="notification_count" class="badge noti-count"><?php echo my_total_unseen_notification();?></span>
    <?php } ?>
    

    <?php if ($this->session->userdata('is_login') == TRUE): ?>
        <li class="dropdown">
            <a id="notificationLink" href="#"><i class="fa fa-bell-o"></i></a>
        </li>
    <?php endif ?>

    <div id="notificationContainer">
        <div class="nitification_heading">
            <h2>Notifications</h2>
        </div>


            <div id="notifications_container" class="notificationsBody">


            </div>

        <div style="display:block; text-align: center; padding-bottom: 10px; background: #F2F4F8;" class="notificationFooter">
            <a href="<?php echo base_url('notifications/all');?>">See all <i class="fa fa-angle-right"></i></a>
        </div>

    </div>

</div>