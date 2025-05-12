<?php 
// Register and load the widget
function medkom_contact_widget() {
    register_widget( 'contact_widget' );
}
add_action( 'widgets_init', 'medkom_contact_widget' );

//Contact info Widget 
class contact_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'contact_widget', 
      __('Khelo Contact Info', 'medkom'),
      array( 'description' => __( 'Display your contact info!', 'medkom' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $image_src = '';
        $title    = apply_filters('widget_title', $instance['title']);       
        $address  = $instance['address'];       
        $email  = $instance['email'];
        $phone   = $instance['phone'];
        $hour   = $instance['hour'];
        $fax   = $instance['fax'];
        $app   = $instance['app'];
        $display_image = false;
        if(isset($instance['image'])){
            $display_image = 1;
            $image_src = wp_get_attachment_image_src($instance['image'],"full");
        }
        echo wp_kses_post($before_widget); 
        if ( $title )
        echo wp_kses_post($before_title . $title . $after_title); ?>
  
  <!-- Contact Info Widget -->
  <ul class="fa-ul">

		<?php   
    if( $image_src != '' ){?>
         <li class="about-widget-img">
          <?php if($instance['url']){?>
              <a  href='<?php echo esc_url($instance['url']);?>'><img alt="<?php esc_html_e('image','medkom');?>" src="<?php echo esc_url($image_src[0]);?>"></a>
          <?php } else {?>
              <img alt="<?php esc_html_e('image','medkom');?>" src="<?php echo esc_url($image_src[0]);?>">
          <?php } ?>
            </li>
      <?php } 
          

		if (!empty($address))
		      echo '<li><i class="fa fa-globe" ></i>'. esc_html($address) .'</li>';
		if (!empty($phone))
		      echo '<li><i class="fa fa-phone" ></i><a href="tel:'. esc_attr(str_replace(" ","", ($phone))) .'">'. esc_html($phone) .'</a></li>';
		
		if (!empty($email))
		      echo '<li><i class="fa fa-envelope" ></i><a href="mailto:'. esc_attr($email) .'">'. esc_html($email) .'</a></li>';
    if (!empty($fax))
          echo '<li><i class="fa fa-fax" ></i>'. esc_html($fax) .'</li>';  
    if (!empty($app))
    echo '<li><i class="fa fa-whatsapp" ></i>'. esc_html($app) .'</li>';  
		if (!empty($hour))
		      echo '<li><i class="fa fa-clock-o"></i>'. esc_html($hour) .'</li>';		
		?>

  </ul>

      <?php echo wp_kses_post($after_widget); ?>
     <?php
    }
 
  /** @see WP_Widget::update  */
  function update($new_instance, $old_instance) {   
      $instance            = $old_instance;
      $instance['title']   = strip_tags($new_instance['title']);
      $instance['address'] = strip_tags($new_instance['address']);	
      $instance['email']   = strip_tags($new_instance['email']);
      $instance['phone']   = strip_tags($new_instance['phone']);
      $instance['hour']    = strip_tags($new_instance['hour']);
      $instance['fax']     = strip_tags($new_instance['fax']);
      $instance['app']     = strip_tags($new_instance['app']);  
      $instance['image']   = strip_tags($new_instance['image']);
      $instance['url']     = strip_tags($new_instance['url']);      
      return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  

       $title   = (isset($instance['title']))? $instance['title'] : '';    
       $address = (isset($instance['address']))? $instance['address'] :''; 
       $email   = (isset($instance['email']))? $instance['email'] : '';
       $phone   = (isset($instance['phone']))? $instance['phone'] : '';
       $hour    = (isset($instance['hour']))? $instance['hour'] : '';
       $fax     = (isset($instance['fax']))? $instance['fax'] : '';
       $app     = (isset($instance['app']))? $instance['app'] : '';

        if(!isset($instance['url'])) {
          $instance['url'] = "";
        }
        if(!isset($instance['image'])) {
          $instance['image'] = "";
        }

     ?>


      
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_js( $title); ?>" />
        </p> 

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image:','medkom'); ?></label>
            <br/>
            <p class="imgpreview"></p>
            <input class="imgph" type="hidden" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>"  value="<?php echo esc_attr($instance['image']);?>"  />
            <input type="button" class="button btn-primary widgetuploader" value="<?php esc_html_e('Add Image','medkom'); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('Target URL:','medkom'); ?></label>
            <br/>
            <input class="widefat" type="url" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" value="<?php echo esc_attr($instance['url']);?>" />
        </p>       
        
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_js($address); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_js($phone); ?>" />
        </p>
       
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_js($email); ?>" />
        </p>  

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('app')); ?>"><?php esc_html_e('WhatsApp:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('app')); ?>" name="<?php echo esc_attr($this->get_field_name('app')); ?>" type="text" value="<?php echo esc_js($app); ?>" />
        </p>     
        
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('fax')); ?>"><?php esc_html_e('Fax:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax')); ?>" name="<?php echo esc_attr($this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_js($fax); ?>" />
        </p>
        <p>
          <label for="<?php echo esc_attr($this->get_field_id('hour')); ?>"><?php esc_html_e('Opening Hour:', 'medkom'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('hour')); ?>" name="<?php echo esc_attr($this->get_field_name('hour')); ?>" type="text" value="<?php echo esc_js($hour); ?>" />
        </p>
       
        <?php 
    }

 
} // end class
