<?php 
/*
Plugin Name: 微博风云，展示微博价值与影响力排名 与最新微博
Plugin URI: http://www.appmuses.com/plugins/wordpress
Description: 展示您的微博价值与影响力排名，支持查询新浪、腾讯等多家社交网络平台
Version: 1.1
Author: 王浩然
Author URI: http://www.appmuses.com/
*/
/* Copyright 2011 Wang.Haoran (Email : rainsea127@gmail.com)
 * Required Version:
 * PHP5 or higher
 * WordPress 2.7 or higher
 *
 * @author Wang.Haoran
 * @link http://www.appmuses.com/plugins/wordpress
 * @copyright Copyright (C) 2011 - 2012 www.tfengyun.com. All rights reserved.
 * @lastmodified  { Date:2011-08-03 }
*/
class TfengyunWidget extends WP_Widget {
    /** constructor */
    function TfengyunWidget() {
    	$widget_ops = array('description' => '微博风云，在博客中显示你的微博影响力排名和微博价值');
        parent::WP_Widget(false, $name = '微博风云', $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                  <?php
        		$weiboid = $instance['weiboid'];
        		//echo "我的微博排名:<a href=http://www.tfengyun.com/user.php?screen_name=".$weiboid." target='_blank'>".$weiboid."</a><br>";
					?>
					<script type="text/javascript">
						var url=" http://image.tfengyun.com/userinfo.js.php?type=_baljlajlj____d&name="+encodeURIComponent('<?php echo $weiboid ?>');
						var tfengyun_width = '100%';
					</script>
					<script src="http://image.tfengyun.com/js/tfengyunData.js" type="text/javascript"></script>
                  <!-- 不管你信不信，反正我信了<br>
                  这TMD是一个奇迹 -->
        <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['weiboid'] = strip_tags($new_instance['weiboid']);
      return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = esc_attr($instance['title']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
        	<?php
        		$instance = wp_parse_args((array)$instance,array('weiboid'=>''));
        		$weiboid = htmlspecialchars($instance['weiboid']);
					?>
					<label for="<?php echo $this->get_field_name('weiboid'); ?>" >请填写您的新浪微博昵称：
          <input class="widefat" id="<?php echo $this->get_field_id('weiboid'); ?>" name="<?php echo $this->get_field_name('weiboid'); ?>" type="text" value="<?php echo $instance['weiboid']; ?>" />
        	</label>
        </p>
        <?php 
    }
} 
// class TfengyunWidget
// register TfengyunWidget widget
add_action('widgets_init', create_function('', 'return register_widget("TfengyunWidget");'));