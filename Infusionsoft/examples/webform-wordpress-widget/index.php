<?php
/*
Plugin Name: Infusionsoft WebForms
Plugin URI: http://http://code.google.com/p/php-infusionsoft-sdk/
Description: This plugin allows you to easily add an Infusionsoft WebForm to your blog as a widget.
Version: 0.0.1
Author: Joey Novak
Author URI: http://joeynovak.com
*/

define('INFUSIONSOFT_WEBFORM_VERSION', '0.0.1');

add_action("widgets_init", "infusionsoftWebForm");

function infusionsoftWebForm(){
  register_widget('Infusionsoft_WebForm_Widget');    
}
	
class Infusionsoft_WebForm_Widget extends WP_Widget {
	function Infusionsoft_WebForm_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => 'A widget that displays an Infusionsoft WebForm' );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'infusionsoft-webform-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'infusionsoft-webform-widget', 'Web Form', $widget_ops, $control_ops );
	}
	
	function widget($args, $instance) {
	  extract($args);
	  echo $before_widget;	  
	  echo $before_title . $instance['title'] . $after_title;
	  echo $instance['webformsource'];
	  echo $after_widget;
	}
	
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'My WebForm', 'apphostname' => '.infusionsoft.com');
		$instance = wp_parse_args( (array) $instance, $defaults );		
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br/>
			<input style="width: 200px;" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<?php 
		//Display Title of webform...
		
		if(isset($instance['apphostname']) && isset($instance['appapikey'])){
			$webforms = $this->getWebForms($instance); 
			if(is_array($webforms)){
				?>					
					<p>
						<label for="<?php echo $this->get_field_id( 'webform' ); ?>">WebForm:</label><br/>
						<?php echo $this->getWebFormSelect($webforms, $instance); ?><br/><br/>
						<strong>Note:</strong> Web Form Source will update after you save.
											
					</p>				 				
					<p>
						<label for="<?php echo $this->get_field_id( 'webformsource' ); ?>">Web Form Source:</label>						
							(You can edit this as long as you don't change webforms.)<br/>
						
						<textarea style="width: 210px; height: 300px;" id="<?php echo $this->get_field_id( 'webformsource' ); ?>" name="<?php echo $this->get_field_name( 'webformsource' ); ?>"><?php echo htmlentities($instance['webformsource']); ?></textarea>												
					</p>	
				<?php 						 							
			}															
			else{
				echo '<span style="color: red; font-weight: bold;">Error Communication with Infusionsoft, please check your Infusionsoft URL, APIKey, and ensure that this servers IP Address is in the allowed list.</span><br/>';
				$this->displayAppForm($instance);		
			}
		}
		else{
			$this->displayAppForm($instance);
		}
	}
	
	function displayAppForm($instance){
		?>					
			<p>
				<label for="<?php echo $this->get_field_id( 'apphostname' ); ?>">Infusionsoft URL:</label><br/>
				https://<input id="<?php echo $this->get_field_id( 'apphostname' ); ?>" name="<?php echo $this->get_field_name( 'apphostname' ); ?>" value="<?php echo $instance['apphostname']; ?>" />						
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'appapikey' ); ?>">API Key:</label><br/>
				<input id="<?php echo $this->get_field_id( 'appapikey' ); ?>" name="<?php echo $this->get_field_name( 'appapikey' ); ?>" value="<?php echo $instance['appapikey']; ?>" />						
			</p>
			<p><strong>Save to view available webforms.</strong></p>
		<?php 
	}
	
	function getWebForms($instance){		
		require_once('infusionsoft_sdk.php');
		$app = new Infusionsoft_App($instance['apphostname'], $instance['appapikey']);
		$webforms = array();
		try{		
			$webforms = Infusionsoft_WebFormService::getMap($app);
		}
		catch(Exception $e){
			$webforms = false;
		}
		return $webforms;
	}
	
	function getWebFormHtml($instance){
		require_once('infusionsoft_sdk.php');
		$app = new Infusionsoft_App($instance['apphostname'], $instance['appapikey']);
		try{		
			$html = Infusionsoft_WebFormService::getHTML($instance['webformid'], $app);
		} catch(Exception $e){
			
		}
		return $html;
	}
	
	function getWebFormSelect($webforms, $instance){
		?>
		<select style="width: 210px;" id="<?php echo $this->get_field_id( 'webformid' ); ?>" name="<?php echo $this->get_field_name( 'webformid' ); ?>">
		<?php 
		
		foreach($webforms as $id=>$title){
			?>
				<option <?php if($id == $instance['webformid']) echo 'selected'; ?> value="<?php echo $id; ?>"><?php echo $title; ?></option>
			<?php 
		}	
		?></select><?php 
	}
	
	function formatHostname($hostname){
		return $hostname;
	}
	
	
	function update( $new_instance, $old_instance ) {
		$webform_changed = false;
		if(isset($new_instance['webformid']) && $old_instance['webformid'] != $new_instance['webformid']){
			$webform_changed = true;					
		}			
		
		$new_instance = array_merge($old_instance, $new_instance);
		 
		if($webform_changed){			
			$new_instance['webformsource'] = trim($this->getWebFormHtml($new_instance));
		}
		return $new_instance;				
	}				
}

