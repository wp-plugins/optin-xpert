<div class="wrap">
<h2>Xpert Optin</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'xpert-settings-group' ); ?>
    <?php do_settings_sections( 'xpert-settings-group' ); ?>

<table class="form-table">

  <tr valign="top">
    <th scope="row">Optin Type</th>
      <td>
        <select name="optin_type" id="optin_type_hook">
          
          <option data-addon-layout="lightbox-layout" value="lightbox"  <?php selected( get_option('optin_type' ), 'lightbox' ); ?>>Light Box</option>
          <option data-addon-layout="flyer-layout" value="flyin" <?php selected( get_option('optin_type' ), 'flyin' ); ?>>Flyin</option>
          <option data-addon-layout="stickytop-layout" value="stickytop" <?php selected( get_option('optin_type' ), 'stickytop' ); ?>>Sticky Top</option>
         </select>
      </td>
  </tr>

  <tr class="addon-settings-layout lightbox layout-hide" data-addon-layout="lightbox-layout"  valign="top">
     <th scope="row">Styles</th>
      <td>
        <select id="lightbox-layout" class="image-picker show-html" name="lightbox-layout">

          <option data-addon-layout="lightbox-layout1" data-img-src=" <?php echo plugins_url('assets/image/lightbox/lightbox1.svg', __DIR__) ?>" value="lightbox-layout1"<?php selected( get_option('lightbox-layout' ), 'lightbox-layout1' ); ?>></option>
          <option data-addon-layout="lightbox-layout2" data-img-src=" <?php echo plugins_url('assets/image/lightbox/lightbox2.svg', __DIR__) ?>" value="lightbox-layout2"<?php selected( get_option('lightbox-layout' ), 'lightbox-layout2' ); ?>></option>
          <option data-addon-layout="lightbox-layout3" data-img-src=" <?php echo plugins_url('assets/image/lightbox/lightbox3.svg', __DIR__) ?>" value="lightbox-layout3"<?php selected( get_option('lightbox-layout' ), 'lightbox-layout3' ); ?>></option>

        </select>
    </td>
  </tr>


  <tr class="addon-settings-layout flyin  layout-hide" data-addon-layout="flyer-layout" valign="top">
     <th scope="row">Styles</th>
      <td>
        <select id="flyer-layout" class="image-picker show-html" name="flyer-layout">

          <option data-addon-layout="flyer-layout1" data-img-src=" <?php echo plugins_url('assets/image/flyer/flyer1.svg', __DIR__) ?>" value="flyer-layout1"<?php selected( get_option('flyer-layout' ), 'flyer-layout1' ); ?>></option>
          <option data-addon-layout="flyer-layout2" data-img-src=" <?php echo plugins_url('assets/image/flyer/flyer2.svg', __DIR__) ?>" value="flyer-layout2"<?php selected( get_option('flyer-layout' ), 'flyer-layout2' ); ?>></option>
          <option data-addon-layout="flyer-layout3" data-img-src=" <?php echo plugins_url('assets/image/flyer/flyer3.svg', __DIR__) ?>" value="flyer-layout3"<?php selected( get_option('flyer-layout' ), 'flyer-layout3' ); ?>></option>

        </select>
    </td>
  </tr>


  <tr class="addon-settings-layout stickytop layout-hide" data-addon-layout="stickytop-layout" valign="top">
     <th scope="row">Styles</th>
      <td>
        <select id="stickytop-layout" class="image-picker show-html" name="stickytop-layout">

          <option data-addon-layout="stickytop-layout1" data-img-src=" <?php echo plugins_url('assets/image/stickytop/stickytop1.svg', __DIR__) ?>" value="stickytop-layout1"<?php selected( get_option('stickytop-layout' ), 'stickytop-layout1' ); ?>></option>
          <option data-addon-layout="stickytop-layout2" data-img-src=" <?php echo plugins_url('assets/image/stickytop/stickytop2.svg', __DIR__) ?>" value="stickytop-layout2"<?php selected( get_option('stickytop-layout' ), 'stickytop-layout2' ); ?>></option>
          <option data-addon-layout="stickytop-layout3" data-img-src=" <?php echo plugins_url('assets/image/stickytop/stickytop3.svg', __DIR__) ?>" value="stickytop-layout3"<?php selected( get_option('stickytop-layout' ), 'stickytop-layout3' ); ?>></option>

        </select>
    </td>
  </tr>


<tr valign="top">
    <th scope="row">Customize</th>
      <td>
        <select name="layout_custom" id="layout_custom">          
          <option value="no"<?php selected( get_option('layout_custom' ), 'no' ); ?>>No</option>
          <option data-addon="layout-custom" value="yes"  <?php selected( get_option('layout_custom' ), 'yes' ); ?>>Yes</option>        
        </select>
      </td>
  </tr>   

  <tr class="addon-settings hide" data-addon="layout-custom" valign="top">
    <th scope="row">Image</th>
      <td>
        <input name = "optin_upload_media" type="text" id="tx-new-media-image" size="70" value="<?php echo esc_attr( get_option('optin_upload_media') ); ?>" />
        <a href="#" class="tx-open-media button button-primary" >Upload Image</a>
    </td>
  </tr>

  <tr class="addon-settings hide" data-addon="layout-custom" valign="top" id="editor_input">
    <th scope="row">Text</th>
     <td name="wp_editor_text">
        <div>
           <?php
            $settings = array( 'wp_editor_data' => 'wp_editor_data',
                         'quicktags' => false,
                         'wpautop' => false,
                         'mce-ico' => false,
                         'formatselect' => true,
                         'textarea_id'=> 20,
                         'media_buttons' => false,
                         'teeny' => false,
                         'tinymce'=> array(
                          'height' => '300',
                          'width' => '100%',
                          //'forced_root_block' => "h2",
                         'theme_advanced_disable' => 'fullscreen'
                         ));
          wp_editor(  get_option('wp_editor_data'),'wp_editor_data', $settings );?>
        </div>
     </td>
  </tr>

 <tr  valign="top">
     <th scope="row">MailChimp API Key</th>
      <td>
        <input type="text" name="optin_mailchimp_api" 
          placeholder="Enter MailChimp API Key" 
          value="<?php echo $mc_api_key; ?>" />

        <select name="mc_list"> 
          <?php foreach ((array)$mc_lists as $list): ?>
              <option value="<?php echo $list['id'] ?>" <?php echo selected($list['id'], $mc_list); ?>>
                 <?php echo $list['name']; ?>
              </option>
          <?php endforeach; ?>
        </select>
      </td>
  </tr>


<tr valign="top">
  <th scope="row">Trigger</th>
    <td>
      <select name="optin_timer">
        <option value="select"<?php selected( get_option('optin_timer' ), 'select' ); ?>>Select Your--</option>
        <option value="onload"<?php selected( get_option('optin_timer' ), 'onload' ); ?>>On Load</option>
        <option value="5000"  <?php selected( get_option('optin_timer' ), '5000'  ); ?>>5 SECOND</option>
        <option value="10000" <?php selected( get_option('optin_timer' ), '10000' ); ?>>10 SECOND</option>
        <option value="15000" <?php selected( get_option('optin_timer' ), '15000' ); ?>>15 SECOND</option>
        <option value="20000" <?php selected( get_option('optin_timer' ), '20000' ); ?>>20 SECOND</option>
        <option value="scrolldown" <?php selected( get_option('optin_timer' ), 'scrolldown' ); ?>>SCROLL DOWN</option>
    </select>
    </td>
</tr>

  <tr valign="top">
    <th scope="row">Expire Length</th>
      <td>
        <input type="text" name="optin_session_input" value="<?php echo esc_attr( get_option('optin_session_input') ); ?>" required/>
        <select name="optin_session_value">
          <option value="select"  <?php selected( get_option('optin_session_value' ), 'select' ); ?>>Select Your--</option>
          <option value="60"  <?php selected( get_option('optin_session_value' ), '60' ); ?>>Minutes</option>
          <option value="3600"  <?php selected( get_option('optin_session_value' ), '3600' ); ?>>Hours</option>
          <option value="86400"  <?php selected( get_option('optin_session_value' ), '86400' ); ?>>Days</option>
          <option value="2592000"  <?php selected( get_option('optin_session_value' ), '2592000' ); ?>>Months</option>
         </select>
      </td>
  </tr>

<tr valign="top">
<th scope="row">Load Home Page</th>
  <td>
    <input type="checkbox" name="is_home" value="true"<?php if (get_option('is_home')==true) echo 'checked="checked" '; ?>>    
  </td>
</tr>
  <tr valign="top">
    <th scope="row">Post</th>
      <td >        
        <select id="post_id" name="post_id[]" multiple="multiple" accesskey="e"> 
          <?php foreach ($posts as $post): ?>
            <option value="allpost"<?php echo selected(in_array('allpost', $selected_post)); ?>>All Post</option>
            <option value="<?php echo $post->post_name; ?>" <?php echo selected(in_array($post->post_name, $selected_post)); ?>>
                <?php echo $post->post_title; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </td>
  </tr>


  <tr valign="top">
    <th scope="row">Pages</th>
      <td >
        <select id="page_id" name="page_id[]" multiple="multiple" accesskey="e">            
           <option value="allpage"<?php echo selected(in_array('allpage', $selected_page)); ?>>All Pages</option>
           <?php foreach ((array)$pages as $page): ?>               
                <option value="<?php echo $page->post_name; ?>" <?php echo selected(in_array($page->post_name, $selected_page)); ?>>
                    <?php echo $page->post_title; ?>
           </option>
          <?php endforeach; ?>
        </select>
     </td>
  </tr>
</table>

<?php submit_button(); ?>

</form>
</div>
