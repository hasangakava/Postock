<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php foreach($notification as $row):?>

  <?php 

      if($row['noti_type'] == 1){
        $noty_link = '#';
        $image = 'assets/images/admin.png';
        $message = $row['text'];

      }elseif($row['noti_type'] == 2 ){

        $image = 'assets/images/admin.png';
        $noty_link = base_url('photos/details/'.md5($row['content_id']));
        $message = $row['text'];

      }elseif($row['noti_type'] == 3 ){

        $image = 'assets/images/avatar.png';

        $noty_link = base_url('user/profile/'.md5($row['content_id']));
        $message = '<b>'.$row['name'].'</b> '.$row['text'];

      }elseif($row['noti_type'] == 4 ){

        if($row['thumb'] == ''){
            $image = 'assets/images/avatar.png';
        }else{
            $image = $row['thumb'];
        }
        $noty_link = base_url('photos/details/'.md5($row['content_id']));
        $message = '<b>'.$row['name'].'</b> '.$row['text'];

      }elseif($row['noti_type'] == 5 ){

        if($row['thumb'] == ''){
            $image = 'assets/images/avatar.png';
        }else{
            $image = $row['thumb'];
        }
        $noty_link = base_url('photos/details/'.md5($row['content_id']));
        $message = '<b>'.$row['name'].'</b> '.$row['text'];

      }elseif($row['noti_type'] == 6 ){

        if($row['thumb'] == ''){
            $image = 'assets/images/avatar.png';
        }else{
            $image = $row['thumb'];
        }
        $noty_link = base_url('photos/details/'.md5($row['content_id']));
        $message = $row['text'];

      }elseif($row['noti_type'] == 7 ){

        if($row['thumb'] == ''){
            $image = 'assets/images/avatar.png';
        }else{
            $image = $row['thumb'];
        }
        $noty_link = base_url('photos/details/'.md5($row['content_id']));
        $message = '<b>'.$row['name'].'</b> '.$row['text'];

      }elseif($row['noti_type'] == 8 ){

        if($row['thumb'] == ''){
            $image = 'assets/images/avatar.png';
        }else{
            $image = $row['thumb'];
        }
        $noty_link = base_url('message');
        $message = '<b>'.$row['name'].'</b> '.$row['text'];

      }else{

        $noty_link = '#';
        $image = 'assets/images/avatar.png';
        $message = $row['text'];
      }

      
  ?>

  <div class="notificationsBody">
    <a href="<?php echo $noty_link;?>">
      <div class="single_notification">
        <div class="notification_img fix floatleft">
          <div class="single_body floatleft">
             <img width="80px" class="img-circle mt-5" src="<?php echo base_url($image);?>" alt="">
          </div>
        </div>

        <div class="notification_desc fix floatright">
          <div class="nitification_date">
            <p><?php echo my_date_show_time($row['noti_time']);?></p>
          </div>
          <div class="nitification_name">
            <p><?php echo $message; ?></p>
          </div>
        </div>
      </div>

    </a>
  </div>
<?php endforeach;?>


