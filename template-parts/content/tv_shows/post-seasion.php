<?php 
$tv_shows_seasons = get_field('tv_shows_seasons');
$seasons_dropdown = jws_theme_get_option('tv_shows_season_type');
$display = jws_theme_get_option('select-layout-episodes-bottom');  
if(isset($_GET['episodes_grid'])) $display = 'grid';
 if(!empty($tv_shows_seasons)) { 
    
    ?>
        <div class="dropdown select-seasion" data-id="<?php echo esc_attr(get_the_ID()); ?>">
          <button class="dropdown-toggle" type="button" data-display="<?php echo esc_attr($display); ?>">
           <?php 
            
            if($seasons_dropdown && $seasons_dropdown == 'name') {
                
            
                echo esc_html($tv_shows_seasons[0]['season_name']);
                
            } else {
                
                echo esc_html__('Season 1','streamvid'); 
                
            }
           
           ?>
           
          </button>
          <ul class="dropdown-menu jws-scrollbar" aria-labelledby="dropdownMenuButton">
            <?php 
            
            foreach($tv_shows_seasons as $index => $seasons) {
                $name = ($seasons_dropdown && $seasons_dropdown == 'name') ? $seasons['season_name'] : esc_html__('Season ','streamvid').($index + 1);
                $class = "dropdown-item";
                if($index == 0) {
                  $class .= ' active';  
                }
                ?>
                 
                 <li>
                  <a class="<?php echo esc_attr($class); ?>" href="#" data-index="<?php echo esc_attr($index); ?>" data-value="<?php echo esc_attr($name); ?>" >
                    <?php echo esc_html($name); ?>
                  </a>
                 </li>
                
                <?php
       
            }
            
            ?>

          </ul>
        </div>
       
    
    <?php
    
 }

?>