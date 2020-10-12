<?php

function my_theme_load_theme_textdomain() {
  load_theme_textdomain( 'arterior', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'my_theme_load_theme_textdomain' );


//add_filter('use_block_editor_for_post', '__return_false', 10);

function load_scripts() {

    global $post;

    wp_register_style('slick',get_template_directory_uri() . '/dist/slick/slick.css', [], 1,'all');
    wp_enqueue_style('slick');

    wp_register_style('slick-theme',get_template_directory_uri() . '/dist/slick/slick-theme.css', [], 1,'all');
    wp_enqueue_style('slick-theme');

    wp_register_style('uniformimages-css',get_template_directory_uri() . '/dist/uniformimages/uniformimages.min.css', [], 1,'all');
    wp_enqueue_style('uniformimages-css');

    wp_register_style('wow-css',get_template_directory_uri() . '/dist/wow/animate.css', [], 1,'all');
    wp_enqueue_style('wow-css');

    wp_register_style('parallux-css',get_template_directory_uri() . '/dist/parallux/dist/jquery.parallux.min.css', [], 1,'all');
    wp_enqueue_style('parallux-css');

    wp_register_style('style',get_template_directory_uri() . '/dist/app.css', [], 1,'all');
    wp_enqueue_style('style');

    wp_enqueue_script('jquery');

    wp_register_script('bootstrap', get_template_directory_uri() . '/dist/bootstrap/js/bootstrap.js', ['jquery'], 1, true);
    wp_enqueue_script('bootstrap');

    wp_register_script('slick', get_template_directory_uri() . '/dist/slick/slick.js', ['jquery'], 1, true);
    wp_enqueue_script('slick');

    wp_register_script('uniformimages-js', get_template_directory_uri() . '/dist/uniformimages/uniformimages.min.js', ['jquery'], 1, true);
    wp_enqueue_script('uniformimages-js');

    wp_register_script('wow-js', get_template_directory_uri() . '/dist/wow/wow.min.js', ['jquery'], 1, true);
    wp_enqueue_script('wow-js');

    wp_register_script('stellar-js', get_template_directory_uri() . '/dist/stellar.js/jquery.stellar.min.js', ['jquery'], 1, true);
    wp_enqueue_script('stellar-js');

    wp_register_script('parallux-js', get_template_directory_uri() . '/dist/parallux/dist/jquery.parallux.min.js', ['jquery'], 1, true);
    wp_enqueue_script('parallux-js');

    wp_register_script('app', get_template_directory_uri() . '/dist/app.js', ['jquery'], 1, true);
    wp_enqueue_script('app');

    $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );

    if(is_front_page()) {
      $translation_array['front_page']= 1;
    } else {
      $translation_array['front_page']= 0;
      $translation_array['site_url']= get_site_url();
    }

    $translation_array['lang'] = get_bloginfo('language');

    //var_dump(get_field('kezdo_sliderkep',$post->ID));die(0);

    $start_slide = get_field('kezdo_sliderkep',$post->ID);

    if($start_slide == NULL || !$start_slide) {
      $start_slide = 0;
    }

    $translation_array['start_slide'] = $start_slide;

    if ( is_user_logged_in() ) {
      // your code for logged in user
      $translation_array['logged'] = 1;
   } else {
      // your code for logged out user
      $translation_array['logged'] = 0;
   }

    //after wp_enqueue_script
    wp_localize_script( 'app', 'object_name', $translation_array );

}

add_action('wp_enqueue_scripts','load_scripts');

add_theme_support( 'post-thumbnails',array('page','post','referencia','termekek','egyedi_butorok','gld_files','bim_tervezes'));

if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
  // File does not exist... return an error.
  return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
  // File exists... require it.
  require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

function wpb_custom_new_menu() {
    register_nav_menus(
      array(
        'main_menu' => __( 'Főmenü',"arterior" ),
        'footer_menu' => __( 'Footer menü',"arterior" ),
        'mobile_menu' => __('Mobil menü',"arterior"),
      )
    );
  }
  add_action( 'init', 'wpb_custom_new_menu' );

function home_refslider() {

  ob_start();

  ?>

  <span class="pagingInfo"></span>
  <div class="home-referencia-slider">
  
  <?php

  $loop = new WP_Query( array( 'post_type' => 'referencia', 'posts_per_page' => 10 ) );

  while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    
    <div class="slide-div">                        
      <div class="slide-div-block">
        <h3><?php the_title();?></h3>
        <?php

          if (has_post_thumbnail( get_the_ID() ) ):
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
            ?><img src="<?php echo $image[0];?>" /><?php
          endif;

        ?>

        <?php
            echo the_content();
        ?>
        <!--<a class="gld_link" target="_BLANK" href="<?php //echo  get_field('gld_file');?>" ><?php //echo __('GLD fájl letöltése >>');?></a>
        <a class="email_link" href="mailto:butorforgalmazas@arterior.hu">butorforgalmazas@arterior.hu</a>-->
      </div>
    </div><!-- end-slide-div -->

  <?php endwhile;

  $content = ob_get_contents();

  ob_end_clean();

  return $content;


}

add_shortcode('home_refslider', 'home_refslider');

function get_specifications_fields() {

	global $post;
	
	$specifications_group_id = 163; // Post ID of the specifications field group.
	$specifications_fields = array();
	
  $fields = acf_get_fields( $specifications_group_id );
  
	
	foreach ( $fields as $field ) {
    $field_value = get_field( $field['name'] );

    //var_export($field);
    //echo '<br />';
		
		//if ( $field_value && !empty( $field_value ) ) {
    //  if (!empty( $field_value ) ) {
			$specifications_fields[$field['name']] = $field;
			$specifications_fields[$field['name']]['value'] = $field_value;
		//}
	}
	
	return $specifications_fields;

}

function search_ret_content($search_str = "") {

  if($search_str == "") {
    return "";
  }

  ob_start();

  $query = new WP_Query( array( 'post_type' => 'termekek', 'posts_per_page' => 10 ) );

  $return_links = array();

  ?><div><?php

  while ( $query->have_posts() ) : $query->the_post();

    ?><div><?php

    $found_search = found_search(get_the_ID(),$search_str);

    /*echo '<pre style="color:red;">';
    var_export($found_search);
    echo "</pre>";*/

    if(is_array($found_search)){
      /*if(isset($found_search['filter_cat']) && !isset($return_links['filter_cats'][$found_search['filter_cat']])) {
        echo "Search str: ";var_export(strpos(strtolower($found_search['filter_cat']),strtolower($search_str)));
        if(strpos(strtolower($found_search['filter_cat']),strtolower($search_str)) !== false){
          $return_links['filter_cats'][$found_search['filter_cat']][] = '<div class="ret_bar_link" data-typ="category" data-label="'.$found_search['filter_cat'].'">'.show_bolded($found_search['filter_cat'],$search_str).'</div>';
        }
      } elseif(isset($found_search['filter']) && !isset($return_links['filter'][$found_search['filter']])) {
        if(strpos(strtolower($found_search['filter']),strtolower($search_str)) !== false){
          $return_links['filters'][$found_search['filter']][] = '<div class="ret_bar_link">' . show_bolded($found_search['filter'],$search_str) . '</div>';
        }
      }*/
      if(isset($found_search['filter_cat'])) {
        foreach($found_search['filter_cat'] as $filter_cat) {
          //var_export($filter_cat);echo " filter cat <br />";
          if(!isset($return_links['filter_cat'][$filter_cat])) {
            $return_links['filter_cat'][$filter_cat] = '<div class="ret_bar_link" data-typ="category" data-label="'.$filter_cat.'">'.show_bolded($filter_cat,$search_str).' ('.__('kategória',"arterior").')</div>';
          }
        }
      }
      if(isset($found_search['filter'])) {
        foreach($found_search['filter'] as $cat=>$filter) {

          $acf = acf_get_fields(163);

          foreach($acf as $category) {
            if($category['name'] == $cat){
            /*echo "filter <pre>";
            echo "acf: ";var_export($category);
            var_export($filter);
            echo "</pre>";*/
            $label = $category['label'];
            }
          }

          
          //foreach($filter as $link) {
            if(!isset($return_links['filters'][$cat][$filter])){
              $return_links['filters'][$cat][$filter] = '<div class="ret_bar_link" data-cat="'.$cat.'" data-choice="'.$filter.'">'.$label .' => ' . show_bolded($filter,$search_str) . '</div>';
            }
          //}
        }
        
      }
      if(isset($found_search['title'])) {

          $title = get_the_title($found_search['title']);

          $id = $found_search['title'];

          /*echo "filter <pre>";
          var_export($found_search['title']);
          echo "</pre>";*/
         
          if(!isset($return_links['products'][$id])){
            //$title = get_the_title();
            $return_links['products'][$id] = '<div class="ret_bar_link" data-href="'.get_permalink($id).'">'.show_bolded($title,$search_str).'</div>';
          }
      }
    } else {
      //echo "no";
    }

    ?></div><?php

  endwhile;
  
  $ret_html = "";

  /*if(is_array($return_links['filter_cat'])) {

    // Ezt nem kell törölni!!!!!!!!
    
    foreach($return_links['filter_cat'] as $cats) {
      $ret_html .= $cats;
    }
  }*/

  if(is_array($return_links['filters'])) {
    
    /*echo "filter: <pre>";
    var_export($return_links['filters']);
    echo "</pre>";*/

    foreach($return_links['filters'] as $category=>$filter) {
     
      //$ret_html .= '<p>Itt: <strong>'.$category.'</strong></p>';
      foreach($filter as $tag=>$link) {
        //$ret_html .= $link . "(".$category.")";
        $ret_html .= $link;
      }
    }
  }

  if(is_array($return_links['products'])) {
    foreach($return_links['products'] as $product) {
      $ret_html .= $product;
    }
  }
  
  /*echo '<pre style="color:green;">';
  var_export($return_links);
  echo "</pre>";*/

  echo $ret_html;

  

  ?></div><?php

  $ret = ob_get_contents();

  ob_end_clean();

  return $ret;

  //return $ret_html;
}

function show_bolded($target_str = "", $sub_str = "") {

  $strpos = strpos($target_str,$sub_str);

  $strlen = strlen($sub_str);

  $insert_str = substr($target_str,$strpos,$strlen);

  $ret_str = substr($target_str,0,$strpos);

  $ret_str = $ret_str . '<strong style="color:yellow;">' . $insert_str . "</strong>" . substr($target_str,$strpos+$strlen,strlen($target_str));

  return $ret_str;

}


function found_search( $id = NULL, $search_str = "" ) {
  
  $return = false;

  if(!empty($search_str)) {

    $termek = get_post($id);

    $strpos = strpos(strtolower($termek->post_title),strtolower($search_str));

    if($strpos !== false) {
      $return["title"] = $id;
    }

    $strpos = strpos(strtolower($termek->post_excerpt),strtolower($search_str)); 

    if($strpos !== false) {
      $return["excerpt"] = $id;
    }

    $field_objects = get_field_objects($id);
    foreach($field_objects as $filter_cat=>$filter_object){
      if($filter_object['parent'] == 163) {

        $filters = $filter_object["value"];

        if(count($filters) > 0) {

          $strpos = strpos(strtolower($filter_object["label"]),strtolower($search_str));

          if($strpos !== false) {
            $return["filter_cat"][] = $filter_object["label"];
          }

          foreach($filters as $filter) {
           
            $strpos= strpos(strtolower($filter["label"]),strtolower($search_str));
            
            if($strpos !== false) {
              /*if(!isset($return["filter_cat"])) {
                $return["filter_cat"]= $filter_object["label"];
              }*/
              //var_export($filter_object);
              $return["filter"][$filter_object["name"]]= $filter["label"];
            }

          }

        }

      }
    }

    
  }

  return $return;


}

 

function get_acf_fields() {

  $ret = array();
  //$ret[2]['name'] = "kategoria";

  $query = new WP_Query( array( 'post_type' => 'termekek', 'posts_per_page' => 10 ) );

  while ( $query->have_posts() ) : $query->the_post();

  
    //if(is_array(found_search(get_the_ID(),""))) {

        $acf = get_field_objects();

        //the_title();

        $i = 0;

        foreach($acf as $filtercat=>$filters) {
          if($filters['parent'] == 163){
            //echo "<pre>";
            //var_export($filters);
            /*if(is_array($ret[$i])){
              var_dump(array_search($filtercat,$ret));
            }
            echo "</pre>";
            echo "<pre>";*/
            //var_export($filters['value']);
            //if(is_array($filters['value']) && !empty($filters['value'] > 0)){
              foreach($filters['value'] as $filter) {
                //var_export($filter['value']);
                //var_export($i);
                //var_export($filtercat);
                if(!isset($ret[$i]['name'][$filtercat])) {
                  $ret[$i]['name'] = $filtercat;
                  $ret[$i]['label'] = $filters['label'];
                  $ret[$i]['choices'][$filter["value"]] = $filter["label"];
                }
              }
            //}
            $i++;
            //echo "</pre>";
          }
        }
    //}

  endwhile;
 /* echo "<pre>";
  var_export($ret);
  echo "</pre>";*/

  return $ret;

}

function home_termekslider($attr)  {

  //$actcat = NULL, $filters = NULL, $xhr

  $args = shortcode_atts( array(
     
    'actcat' => NULL,
    'filters' => NULL,
    'xhr' => NULL,
    'act_choice' => NULL,
    'erasefilter' => NULL

  ), $attr );

  //var_dump($args);

  $actcat = $args['actcat'];
  $filters = $args['filters'];
  $xhr = $args['xhr'];
  $act_choice = $args['act_choice'];
  $erasefilter = $args['erasefilter'];

  $filters_array = array();

  //var_dump($xhr);

  ob_start();

  ?>
  <?php if(!$xhr):?>
  <div class="filter-container">
  <?php endif;?>
    <div class="filter-container-left">
    <!--<div style="position:relative;height:auto;width:100%;display:block;float:left;max-width:75%;">-->
    <div class="filter-categories-bar">
    <?php

      //$fields = acf_get_fields(163);
      /*echo "<pre>";
      var_export($fields);
      echo " vége </pre>";*/
      $fields = get_acf_fields();


      if(!$xhr && count($fields) > 0 && ($actcat == NULL) || ($erasefilter == 1)) {
        $actcat = $fields[0]['name'];
      }

      $actcat_class = "";

      foreach($fields as $field) {
        
        if($actcat !== NULL && $actcat == $field['name']) {
          $actcat_class = ' active-cat';
          $actcatfoot_class = " active-foot-class";
        } else {
          $actcat_class = "";
          $actcatfoot_class = "";
        }

        ?><div class="category-link-container"><div class="category-link<?php echo $actcat_class;?>" data-catname ="<?php echo $field['name'];?>"><?php echo $field['label']?></div><div class="category-link-footer <?php echo $actcatfoot_class;?>"></div></div><?php

      }
      //var_dump($erasefilter);
      if($filters == NULL|| $erasefilter == 1) {
        $filters = array();
        foreach($fields as $field) {
          //var_dump($field);
          $filters[$field['name']] = array();
        }
        
      }
      //var_dump($filters);

    ?>
    <div id="erase-filters" class="erase-filters-button">szűrő törlése</div>
    </div><!-- end categories-bar -->
    <!--<div class="filters-search" >
      <div class="search_bar">
        <input name="search_bar" class="search-input" type="text" />
        <div class="click-button"></div>
      </div>
      <div class="ret_bar"></div>
    </div>-->
    <div class="filters-elements-container">
      <?php

        //$fields = acf_get_fields(163);

        $fields = get_acf_fields();

        /*echo "<pre>";
        var_export($fields);
        echo " vége </pre>";*/

        $visible_class = "";

        $erase_filters_button = 0;

        foreach($fields as $field) {
          //var_dump($field);
          if($actcat == $field['name']){
            $visible_class = " visibled";
          } else {
            $visible_class = "";
          }
          
          ?><div class="filter-elements<?php echo $visible_class;?>" id="<?php echo $field['name'];?>" data-actchoice="<?php echo $act_choice;?>">
          
          <?php
            //var_dump($erasefilter);
            //var_dump($act_choice);
            //var_dump($filters);
            //var_dump($field['name']);
            ?><?php

          foreach($field['choices'] as $choice) {

            $checked = 'false';

            $checked_class = "";

            if($xhr && $erasefilter !== 1) {

              $index = array_search($choice,$filters[$field['name']]);

              if($actcat == $field['name'] && $choice === $act_choice) {
                if($index === false) {
                  $filters[$field['name']][] = $choice;
                  $checked = 'true';
                  $checked_class = "border:1px solid #ffffff";
                  //$erase_filters_button++;
                } elseif($index >= 0) {
                  unset($filters[$field['name']][$index]);
                  $checked = 'false';
                  $checked_class = "";
                  //$erase_filters_button--;
                }
              }
              //var_dump(array_search($choice,$filters[$field['name']]));

              if(array_search($choice,$filters[$field['name']]) === false) {
                $checked_class = "";
                if($erase_filters > 0) {
                  $erase_filters_button--;
                }
              } else {
                $checked_class = "background-color:#ffffff;color:#000000;";
                $erase_filters_button++;
              }

              //$index = array_search($choice,$filters[$field['name']]);

            }

            ?><div class="filter-element" style="<?php echo $checked_class;?>" data-choice="<?php echo $choice;?>" data-checked = "<?php echo $checked;?>"><?php echo $choice;?></div><?php
          }
          ?></div><?php
        } 
      ?>
    </div>
    </div>
    <!-- Search field -->
    <div class="filters-search" >
      <div class="search_bar">
        <input name="search_bar" class="search-input" type="text" />
        <div class="click-button"></div>
      </div>
      <div class="ret_bar"></div>
    </div>

    <?php //var_export($filters);?>
    <input type="hidden" name="erase-filters-button" value="<?php echo $erase_filters_button;?>" />
    <input type="hidden" name="actcat" value="<?php echo $actcat;?>" />
    <input type="hidden" name="filters" value="<?php echo base64_encode(json_encode($filters));?>" />
  <?php if(!$xhr):?> 
  </div> <!-- end filter-container -->
  <?php endif;?>

  <?php 
  
        $filters_content = ob_get_contents();

        ob_end_clean();

        ob_start();

  ?>

<?php if(!$xhr):?>
<div class="home-butorforgalmazas-grid-container">
<div class="grid-pager"></div>
<span class="no-results"><?php echo __('Nincs a szűrésnek megfelelő elem!',"arterior");?></span>
<span class="pagingInfo"></span>
<span class="ajax-load"></span>
<div class="home-butorforgalmazas-grid">
<?php endif;?>

<?php
  
  $loop = new WP_Query( array( 'post_type' => 'termekek', 'posts_per_page' => 10 ) );

  $div_count = 0;

  $count = 0;

  $page = 1;

  $start = 0;

  $page_size = 5;

  ?>

  <div id="grid_page_<?php echo $page?>" class="grid-page" style="display:block;">

  <?php

  while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php if(check_filter(get_the_ID(),$filters) == true):?>

      <?php if($count > $page_size):?>
        <?php
          $count = 0;
          $page++;
        ?>
        </div>
        <div id="grid_page_<?php echo $page?>" class="grid-page">
      <?php else: ?>
        <?php $count++;?>
      <?php endif;?>

      <div class="grid-div">                        
          <div class="grid-div-block">
          <?php
          if (has_post_thumbnail( get_the_ID() ) ):
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
          else:
            $image[0] = get_template_directory_uri() . '/images/no-image.jpg';
          endif;
          ?>
          <div class="img-container">
            <img class="unim" src="<?php echo $image[0];?>" />
          </div>
          <?php //endif;?>
          <h2>
            <a href="<?php echo get_permalink();?>"><?php the_title();?></a>
          </h2>
          <p><?php the_excerpt();?></p>
          </div><!-- end grid-div-block -->
      </div><!-- end grid-div -->
      
    <?php //endif;?>

      <?php $div_count++; ?>

    <?php endif;?>

  <?php endwhile; ?>
  </div><!-- end grid page -->
  
<?php if(!$xhr):?>
</div><!-- end home-butorforgalmazas-grid -->
</div><!-- end .home-butorforgalmazas-grid-container -->
<script>
  jQuery('.grid-pager').html('<?php echo grid_pager($page);?>');
</script>
<?php endif;?>
<!--<div class="grid-pager"><?php //echo grid_pager(0,$div_count);?></div>-->
<?php

  $content = ob_get_contents();

  ob_end_clean();

  //return $content;

  //var_dump($xhr);

  if(!$xhr) {

    $return = $filters_content . $content;

    return $return;
  } else {

    $pager_links = grid_pager($page);

    $return = array(
      'filters_content' => $filters_content,
      'content' => $content,
      'test' => 0,
      'count' => $div_count,
      'pager_links' => $pager_links
    );

    return $return;

  }


}

add_shortcode('home_termekslider', 'home_termekslider');


function grid_pager($pages = NULL,$xhr = false) {

  if($pages < 2) {
    return "<span></span>";
  }

  $return = "<span>";

  for($i = 1;$i <= $pages;$i++) {

    if(!$xhr && $i == 1) {
      $act_page = ' act';
    } else {
      $act_page = '';
    }

    $return .= '&nbsp;<a href="javascript:void(0);" id="grid_pager_link_' . $i. '" class="grid-pager-link' . $act_page . '" data-page="'.$i.'">'.$i.'</a>&nbsp;';
  }

  $return .= "</span>";

  return $return;

}

function check_filter($post_id = NULL, $filters = NULL) {

  $return = true;

  //$filter_ret = false;

  ?><?php
  //echo get_the_title( $post_id ) . "<br />";
  foreach($filters as $field => $filter) {
    //var_dump($field);echo " <- field<br />";
    if(count($filters[$field]) > 0) {
      if(!isset($filter_ret) || $filter_ret == NULL) {
        $filter_ret = false;
      }
      foreach($filter as $tag) {
       
        $acf = get_field($field,$post_id);
        //echo "<pre>";var_export($acf);echo "</pre> <- acf<br />";
        foreach($acf as $acf_tag){
          //echo "<pre>";var_dump($acf_tag['label']);echo "</pre> <- acf_tag<br />";
          //var_dump($tag);echo " <- tag<br />";
          if($tag === $acf_tag['label']) {
            $filter_ret = true;
          }
        }
      }
    }
  }
  
  if(isset($filter_ret) && $filter_ret == false) {
    $return = $filter_ret;
  }
  //var_dump($filter_ret);
  //var_dump($return);
  ?><?php
  return $return;

}

function arterior_action_callback() {

        if(isset($_POST['filters'])) {
          $filters = json_decode(base64_decode($_POST['filters']),true);
        }

        if(isset($_POST['actcat'])) {
          $actcat = $_POST['actcat'];
        } else {
          $actcat = NULL;
        }
        if(isset($_POST['actchoice'])) {
          $act_choice = $_POST['actchoice'];
        } else {
          $act_choice = NULL;
        }
        if(isset($_POST['erasefilter'])) {
          $erasefilter = 1;
        } else {
          $erasefilter = NULL;
        }

        $attr = array(
          'filters' => $filters,
          'actcat' => $actcat,
          'xhr' => true,
          'act_choice' => $act_choice,
          'erasefilter' => $erasefilter
        );

        //var_dump($filters);

        echo json_encode(home_termekslider($attr));

        die();

}

add_action('wp_ajax_arterior_ajax_action', 'arterior_action_callback');

add_action('wp_ajax_nopriv_arterior_ajax_action', 'arterior_action_callback');

// Search in Butorforgalmazas - ajax

function arterior_search_action_callback() {
    
    $return = array('status' => 'ok');

    if(isset($_POST['search_string']) && !empty($_POST['search_string'])) {
      //$return['content'] = "Search string " . $_POST["search_string"];
      $return['content'] = search_ret_content($_POST['search_string']);
    } else {
      $return["content"] = "Empty search";
    }

    echo json_encode($return);

    die();
}

add_action('wp_ajax_arterior_search_ajax_action', 'arterior_search_action_callback');

add_action('wp_ajax_nopriv_arterior_search_ajax_action', 'arterior_search_action_callback');

function arterior_retbar_action_callback() {

   //$return = array("status" => "ok", "message" => "retbar");

   //var_dump($_POST);

   if(isset($_POST['filters'])) {
    $filters = json_decode(base64_decode($_POST['filters']),true);
  }

  if(isset($_POST['actcat'])) {
    $actcat = $_POST['actcat'];
  } else {
    $actcat = NULL;
  }
  if(isset($_POST['actchoice'])) {
    $act_choice = $_POST['actchoice'];
  } else {
    $act_choice = NULL;
  }if(isset($_POST['erasefilter'])) {
    $erasefilter = 1;
  } else {
    $erasefilter = NULL;
  }

  $attr = array(
    'filters' => $filters,
    'actcat' => $actcat,
    'xhr' => true,
    'act_choice' => $act_choice,
    'erasefilter' => $erasefilter
  );

  //var_dump($filters);

  echo json_encode(home_termekslider($attr));

   //echo json_encode($return);

   die();
}

add_action('wp_ajax_arterior_retbar_ajax_action', 'arterior_retbar_action_callback');

add_action('wp_ajax_nopriv_arterior_retbar_ajax_action', 'arterior_retbar_action_callback');


add_image_size( 'crunchify-admin-post-featured-image', 120, 120, false );
 
// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'crunchify_add_post_admin_thumbnail_column', 2);
add_filter('manage_pages_columns', 'crunchify_add_post_admin_thumbnail_column', 2);
 
// Add the column
function crunchify_add_post_admin_thumbnail_column($crunchify_columns){
	$crunchify_columns['crunchify_thumb'] = __('Csatolt kép',"arterior");
	return $crunchify_columns;
}
 
// Let's manage Post and Page Admin Panel Columns
add_action('manage_posts_custom_column', 'crunchify_show_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'crunchify_show_post_thumbnail_column', 5, 2);
 
// Here we are grabbing featured-thumbnail size post thumbnail and displaying it
function crunchify_show_post_thumbnail_column($crunchify_columns, $crunchify_id){
	switch($crunchify_columns){
		case 'crunchify_thumb':
		if( function_exists('the_post_thumbnail') )
			echo the_post_thumbnail( 'crunchify-admin-post-featured-image' );
		else
			echo 'hmm... your theme doesn\'t support featured image...';
		break;
	}
}

function wpdocs_custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function egyedibutorok() {

  ob_start();

  ?><?php

  $loop = new WP_Query( array( 'post_type' => 'egyedi_butorok', 'posts_per_page' => 10 ) );

  while ( $loop->have_posts() ) : $loop->the_post();

  ?><div class="egyedibutor-container-elem"><?php
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
  ?>
  <div class="link-container wow flipInX">
    <a href="<?php echo get_permalink();?>" class="egyedibutor-link">
      <div class="link-inner">
        <h3><?php the_title();?></h3>
        <p><?php the_excerpt();?></p>
      </div>
    </a>
    <img src="<?php echo $image[0];?>" />
  </div>
  <?php
  ?></div><?php

  ?><?php

  endwhile;

  $content = ob_get_contents();

  ob_end_clean();

  return $content;

}

add_shortcode('egyedibutorok', 'egyedibutorok');

function gdl_slider() {

  ob_start();

  //$loop = new WP_Query( array( 'post_type' => 'gld_files', 'posts_per_page' => 10 ) );

  $loop = new WP_Query( array( 'post_type' => 'bim_tervezes', 'posts_per_page' => 10 ) );

  ?>

  <div class="bimgo-gdl-slider-container">
    <div class="bimgo-gdl-slider">  
  
  <?php

  while ( $loop->have_posts() ) : $loop->the_post();

    ?><div class="slide-div"><?php

    if (has_post_thumbnail( get_the_ID() ) ):
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
      ?><img src="<?php echo $image[0];?>" /><?php
    endif;
    ?><h2><?php
    the_title();
    ?></h2><?php
    ?><p><?php
    the_excerpt();
    ?></p><?php
    ?>
    <!--<a class="gld_link" target="_BLANK" href="<?php //echo get_field('gld_file');?>" ><?php //echo __('GLD fájl letöltése >>');?></a>
    <a class="email_link" href="mailto:butorforgalmazas@arterior.hu">butorforgalmazas@arterior.hu</a>-->
    <?php
    ?></div><?php

  endwhile;

  ?>

  </div><!-- end bimgo gdl slider -->
</div><!-- end bimgo-gdl-slider-container -->

<?php

  $content = ob_get_contents();

  ob_end_clean();

  echo $content;
}

add_shortcode('gdl_slider','gdl_slider');


function referencia_grid() {

  ob_start();

  ?><?php

  $loop = new WP_Query( array( 'post_type' => 'referencia', 'posts_per_page' => 10 ) );

  $i = 0;

  $more_i = 1;

  while ( $loop->have_posts() ) : $loop->the_post();

  ?>

  <!--<div class="referencia-grid-container">-->
  
  <?php if($i <= 5 ):?>

  <div class="referencia-grid-container-elem">
    
  <?php
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
  ?>
  <div class="link-container">
    <a href="<?php echo get_permalink();?>" class="referencia-grid-link">
      <div class="link-inner">
        <h3><?php the_title();?></h3>
        <p><?php the_excerpt();?></p>
      </div>
    </a>
    <img class="" src="<?php echo $image[0];?>" />
  </div>
  <?php
  $i++;
  ?>

  </div><!-- end referencia grid container elem -->
<!--</div>--><!-- end referencia-grid-container -->

  <?php else: ?>
    <?php if($more_i == 1):?>
      <div class="morebutton-container">
        <a class="referenciak-more" href="#"><?php echo __("MÉG TÖBB","arterior");?></a>
      </div>
      <div class="morebutton-clear" ></div>
      <div class="referencia-grid-more">
    <?php endif;?>
    <div class="referencia-grid-more-container">
      <a href="<?php echo get_permalink();?>" class="referencia-grid-link"><?php the_title();?></a>
    </div>
    <?php if($more_i % 2 == 0):?>
      <div style="clear:both;position:relative;width:100%;height:1px;display:block;"></div>
    <?php endif;?>
    <?php $more_i++;?>
  <?php endif;?>

  <?php

  ?><?php

  endwhile;

  ?>
  <?php if($i > 5):?>
  </div><!-- end referencia-grid-more -->
  <?php endif;?>
  <!--<div class="morebutton-container">
    <a class="referenciak-more" href="#"><?php //echo __("MÉG TÖBB");?></a>
  </div>-->
  <?php

  $content = ob_get_contents();

  ob_end_clean();

  return $content;
}

add_shortcode('referencia_grid','referencia_grid');

function single_slider_images($post_id = NULL) {

  global $dynamic_featured_image;

  if($post_id == NULL) {
    return false;
  }

  $post = get_post($post_id);

  $return = NULL;

  $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );

  if(is_array($image)) {
    $return[] = $image[0];
  }

  if( class_exists('Dynamic_Featured_Image') ):

    //global $dynamic_featured_image;
    //global $post;

    $featured_images = $dynamic_featured_image->get_featured_images( $post->ID );

     if ( $featured_images ):
        foreach( $featured_images as $images ):
          $return[] = $images['full'];
        endforeach;
      endif;

  endif;

  return $return;


}

function need_slider($post_id = NULL) {

  //var_dump(is_search());

  $ret = false;

  if(get_post_type($post_id) == 'page' && get_field('slider_mutatasa',$post_id) !== false) {
    //echo 'igen';
    $ret = true;
  } else {
    //echo 'nem';
    $ret = false;
  }
  if(is_search()) {
    $ret = false;
  }
  //var_dump($ret);
  return $ret;

}

function home_termekgrid() {

  ob_start();
  ?>
  <div class="termekgrid-container">
  <?php
  echo "New butorforgalmazas";

  $content = ob_get_contents();
  ?>
  </div>
  <?php
  ob_end_clean();

  return $content;
}

add_shortcode('home_termekgrid','home_termekgrid');

function elemkonyvtar_link($attr = [], $content = NULL, $tag = '') {

  $args = shortcode_atts( array(

    'szin' => '288bbf',
    'link' => 'javascript:void(0);',
    'szoveg' => '',
    'light' => false

  ), $attr );

  $color = $args['szin'];

  $link = $args['link'];

  $szoveg = $args['szoveg'];

  $light = $args['light'];

  if(!$light) {
    $light_style = "";
  } else {
    $light_style = " light";
  }

  ob_start();

  ?>
  <div class="elemkonyvtar-link-container">
    <a href="<?php echo $link;?>" style="color:#<?php echo $color;?>"><?php echo $szoveg;?></a>
    <span class="info-button<?php echo $light_style;?>"></span>
    <div class="info-button-container">
      <?php
            echo $content;
      ?>
    </div>
  </div>
  <?php

  $content = ob_get_contents();

  ob_end_clean();

  return $content;

}

add_shortcode('elemkonyvtar_link','elemkonyvtar_link');

add_filter('manage_home_slider_posts_columns', 'my_columns');
function my_columns($columns) {
    $columns['oldal'] = 'Oldal';
    $columns['slider_kep'] = 'Slider kép';
    return $columns;
}

add_action('manage_posts_custom_column',  'my_show_columns');
function my_show_columns($name) {
    global $post;
    switch ($name) {
        case 'oldal':
            //$views = get_post_meta($post->ID, 'views', true);
            $oldal_id = get_field('oldal_id',$post->ID);
            $oldal = get_post($oldal_id);
            echo $oldal->post_title;
          break;
        case 'slider_kep':
            $slider_kep_id = get_field('slide_picture',$post->ID);
            //echo $slider_kep_id;
            ?><img style="width:150px;height:auto;"src="<?php echo $slider_kep_id;?>" /><?php
          break;
    }
}
