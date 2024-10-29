<?php if ( ! defined( 'ABSPATH' ) ) exit;

class Ajax_Product_Filter extends WP_Widget {
	
	public $wid_id='';
	
	function __construct() {

		parent::__construct(

			'Ajax_Product_Filter', // Base ID

			__('Phoeniixx Ajax Product Attributes Filter','phoen-ajax-product-Filter'), // Title Name

			array(

				'description' => __( 'Ajax based product filter based on product attributes. ', 'phoen-ajax-product-Filter' ), 

			),

			array(

				'width' => 300,

			)
			 
		);
		
		
	
	}
	
	//display Icons on frontend

	function widget( $args, $instance ){
		
		echo $args['before_widget']; 
							
		$widget_id = $args['widget_id'];

		$this->wid_id=$widget_id;
		
		$gen_settings = get_option('phoe_Ajax_Product_Filter_value');
		
		if($gen_settings['enable_ajax']=='1'){
		
			if (is_shop()||  is_product_category() || is_product_tag() ) {
				
				global $terms;
				
				$att="pa_".$instance['attribute'];
				
				$attm=$instance['attribute'];
				
				$argm = array(
				
					'hide_empty' => false
					
				);
				
				$terms = get_terms($att,$argm ); ?>
				
				<h2 class="widget-title">
				
					<?php echo $instance['title']; ?>
					
				</h2>
				
				<?php 
			
				if($instance['disp_type']=='Selectbox') { ?>
				
					<select style="width: 100px;" class="<?php echo $widget_id; ?>phoe_onclick_select">
						
						<?php 
						
						if(isset($_GET['filter_'.$instance['attribute']])){
									
							$filter_attr= $_GET['filter_'.$instance['attribute']];
							
							$filter_attr = explode(',',$filter_attr);
						
						}
						
						for($i=0;$i<count($terms);$i++){
						
							$vname=$terms[$i]->slug;
							
							?><option datam="<?php echo $terms[$i]->slug; ?>" dataid="<?php echo $terms[$i]->term_id; ?>" dataidm="<?php echo $terms[$i]->term_id; ?>" data-taxonomy="<?php echo $attm; ?>" data-name="<?php echo $terms[$i]->slug; ?>" data-term_id="<?php echo $terms[$i]->term_id; ?>" class="<?php echo $widget_id; ?> phoe_onclick  <?php echo $vname;?>  <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?$widget_id.'active active':'';?>"><?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?'<span class="prepended"></span>'.strtoupper($terms[$i]->name):strtoupper($terms[$i]->name); ?></option>
						
						 <?php 
						
						} ?> 
					
					</select>
					
					<?php 
				 
				}  
				
				if($instance['disp_type']=='link'){ 
			
					if(isset($_GET['filter_'.$instance['attribute']])){
						
						$filter_attr= $_GET['filter_'.$instance['attribute']];
						
						$filter_attr = explode(',',$filter_attr);
					}
					
					for($i=0;$i<count($terms);$i++){
					
						$vname=$terms[$i]->slug; ?>
						
						<a style="cursor: pointer;" dataid="<?php echo $terms[$i]->term_id; ?>" dataidm="<?php echo $terms[$i]->term_id; ?>" datam="<?php echo $terms[$i]->slug; ?>" data-taxonomy="<?php echo $attm; ?>"data-name="<?php echo $terms[$i]->slug; ?>" data-term_id="<?php echo $terms[$i]->term_id; ?>" class="<?php echo $widget_id; ?>click phoe_onclick <?php echo $vname;?>  <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?$widget_id.'active active':'';?>">
							
							<?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?'<span class="'.$widget_id.'prepended prepended"> </span>':'';?><?php echo strtoupper($terms[$i]->name);?>
							
						</a>
						
						<br/> 
					
						<?php 
					
					}
					
				}
				
				
				if($instance['disp_type']=='color')	{ 
			
					$filter_attr= isset($_GET['filter_'.$instance['attribute']])?$_GET['filter_'.$instance['attribute']]:'';
						
					$filter_attr = explode(',',$filter_attr);
			
					for($i=0;$i<count($terms);$i++){
					
						$vname=$terms[$i]->slug;
						
						$jname=$terms[$i]->name; ?>
							
						<a title="<?php echo $terms[$i]->slug; ?> " dataid="<?php echo $terms[$i]->term_id; ?>" dataidm="<?php echo $terms[$i]->term_id; ?>" datam="<?php echo $terms[$i]->slug; ?>" data-taxonomy="<?php echo $attm; ?>"data-name="<?php echo $terms[$i]->slug; ?>" data-term_id="<?php echo $terms[$i]->term_id; ?>" class="<?php echo $widget_id; ?>click phoe_onclick <?php echo $vname;?> <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?$widget_id.'active active':'';?>">
							
							<?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?'<span class="'.$widget_id.'prepended prepended"> </span>':'';?>
								
							<div style="width:35px; height:35px;  cursor: pointer; background-color:<?php echo $instance[$jname];?>; display:inline-block;">
							
							</div>
							
						</a>
						
						 <?php 
						
					}
					
				}
				
				if($instance['disp_type']=='Checkbox'){ 
					
					if(isset($_GET['filter_'.$instance['attribute']])){
						
						$filter_attr= $_GET['filter_'.$instance['attribute']];
						
						$filter_attr = explode(',',$filter_attr);
						
					}
						
					for($i = 0; $i<count($terms); $i++){
						
						$vname = $terms[$i]->slug; ?>
							
						<input <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?'checked':'';?> type="checkbox" title="<?php echo $terms[$i]->name; ?>" dataid="<?php echo $terms[$i]->term_id; ?>" dataidm="<?php echo $terms[$i]->term_id; ?>" datam="<?php echo $terms[$i]->slug; ?>" data-taxonomy="<?php echo $attm; ?>"data-name="<?php echo $terms[$i]->slug; ?>" data-term_id="<?php echo $terms[$i]->term_id; ?>" value="<?php echo $instance[$vname];?>" class="<?php echo $widget_id; ?>click phoe_onclick <?php echo $vname;?>  <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?$widget_id.'active active':'';?>">
						
						<?php echo strtoupper($terms[$i]->name);?>
						
						</br>
							
						<?php 
						
					}
					
				}
				
				if($instance['disp_type']=='radio'){ 
						
					if(isset($_GET['filter_'.$instance['attribute']])){
						
						$filter_attr= $_GET['filter_'.$instance['attribute']];
						
						$filter_attr = explode(',',$filter_attr);
					}
					///print_r($filter_attr);
					for($i = 0; $i<count($terms); $i++){
						
						 $vname = $terms[$i]->slug; 
						 $terms[$i]->name;
						
						?>
						<input <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?'checked':'';?>  type="radio" name="<?php echo $widget_id; ?>radio_select" title="<?php echo $terms[$i]->name; ?>" dataid="<?php echo $terms[$i]->term_id; ?>" dataidm="<?php echo $terms[$i]->term_id; ?>" datam="<?php echo $terms[$i]->slug; ?>" data-taxonomy="<?php echo $attm; ?>"data-name="<?php echo $terms[$i]->slug; ?>" data-term_id="<?php echo $terms[$i]->term_id; ?>" class="<?php echo $widget_id; ?>radio radio <?php echo $widget_id; ?>click phoe_onclick <?php echo $vname;?> <?php echo $vname;?>  <?php echo (isset($filter_attr) && is_array($filter_attr) && !empty($filter_attr) && (in_array($terms[$i]->slug,$filter_attr)))?$widget_id.'active active':'';?>">
						
						<?php echo strtoupper($terms[$i]->name);?>
						
						</br>
							
						<?php 
						
					}
						
				}
			
			} 
				
			$gen_settings = get_option('phoe_Ajax_Product_Filter_value');
			
			$enable_ajax=isset($gen_settings['enable_ajax'])?$gen_settings['enable_ajax']:'';
			
			$content_Selector=isset($gen_settings['content_Selector'])?$gen_settings['content_Selector']:'';
			
			$next_Selector=isset($gen_settings['next_Selector'])?$gen_settings['next_Selector']:'';
			
			$item_Selector=isset($gen_settings['item_Selector'])?$gen_settings['item_Selector']:'';
			
			$product_shown=isset($gen_settings['product_shown'])?$gen_settings['product_shown']:''; 	?>
				
			<input type="hidden" value="<?php echo $content_Selector;?>" name="content_Selector" id="content_Selector" class="content_Selector">
				
			<input type="hidden" value="<?php echo $next_Selector;?>" name="next_Selector" id="next_Selector" class="next_Selector">
						
			<input type="hidden" value="<?php echo $item_Selector;?>" name="item_Selector" id="item_Selector" class="item_Selector">
			
			<input type="hidden" value="<?php echo $instance['disp_type']; ?>"  class="<?php echo $widget_id; ?>disp_type">
			
			<script>
			
				jQuery(document).ready(function($){
					
						
					var product=jQuery('.item_Selector').val();
					
					var products=jQuery('.content_Selector').val();
					
					var next=jQuery('.next_Selector').val();
						
					var disp_typem=jQuery('.<?php echo $widget_id; ?>disp_type').val();  
				
					var ur ='<?php echo $instance['query_type']; ?>';
						
					var curren_attr = '';
					
					var check ='';
					
					var foo=[];
					
					var fname ='';
					
					arrayM=[];
					
					var name ='';
					
					var orname='';
					
					var andname='';
					
					var uniqueNames = [];

							
					jQuery('.<?php echo $widget_id; ?>phoe_onclick_select').change(function(){
						
					
						var my=jQuery('.<?php echo $widget_id; ?>phoe_onclick_select option:selected').attr('datam');
						
						var myclass='.'+my;
				
						
					if( jQuery(myclass).hasClass('active') )
	
					{ 
						//second time click or even time
						
						jQuery(myclass).removeClass('active');

						jQuery(myclass).find(".prepended").remove();
						
						jQuery(myclass).prop('checked',false);
						
						var phoe_val=jQuery(myclass).text();
						
						phoe_val=phoe_val.replace('','');
						
						jQuery(myclass).html(phoe_val);

					}
					 
					else{
						 
						// first time click or odd time
						
						jQuery(myclass).addClass('active');
				  
						jQuery(myclass).prepend('<span class="prepended"> </span>');
						
						jQuery(myclass).prop('checked',true);
				

					  } 
					}); 
					 
					jQuery(".<?php echo $widget_id; ?>radio").change(function(){
						
						jQuery(".<?php echo $widget_id; ?>radio").removeClass( 'active');
						
						jQuery(this).addClass( 'active');
																				
					});
							
					 jQuery('.<?php echo $widget_id; ?>click').click(function(){
							
						//check clicked status on  class applied on color, selecet box, list type display 
						
						var my=jQuery(this).attr('datam');
						
						var myclass='.'+my;
						
							if( jQuery(myclass).hasClass('active') )
			
							{ 
								//second time click or even time
								
								jQuery(myclass).removeClass('active');

								jQuery(myclass).find(".prepended").remove();
								
								jQuery(myclass).prop('checked',false);

							}
							 
							else{
								 
								// first time click or odd time
								jQuery(myclass).addClass('active');
						  
								jQuery(myclass).prepend('<span class="prepended"> </span>');
								
								jQuery(myclass).prop('checked',true);
						

							  } 
					
					});  
					// click on link and send its attribute
					
					jQuery(document).on('click','#<?php echo $widget_id; ?> .phoe_onclick',phoeniixx_ajax_run);
						
					jQuery(document).on('click','.prepended',phoeniixx_ajax_run);

					jQuery(document).on('change','.<?php echo $widget_id; ?>phoe_onclick_select',phoeniixx_ajax_run);
						
					function phoeniixx_ajax_run(){
						
						var taxa='';
						 
						var urlval='';
				
						var attrmj='';
						
						var varsm = {};	
							
						var loader_html = jQuery('.phoeniixx_ajax_filter_loader_html').html();
			
						jQuery(products).append(loader_html);
						
						jQuery(products).find('#phoeniixx_ajax_filter_loader').show();
						
						jQuery(products).find('.phoeniixx_ajax_filter_loader_html_main').show();
						
						
								
						jQuery(".phoe_onclick:checked").each(function() {
										
							var selected_val = $(this).attr('datam');
									
						});
								
						// rest of the display type
						
						jQuery(".active").each(function() {
								
								var selected_val = $(this).attr('datam');
								
						});
						
						jQuery('.phoe_onclick').each(function(){
							
							if(!jQuery(this).hasClass('active')){
						
							   curren_attr = jQuery(this).attr('data-name')+','+name;

							   jQuery(this).attr('data-name',curren_attr);
						
							}
							
						});
						
						var selected_texa = '';
						
						if(jQuery('.active').length >0){
							
							jQuery('.active').each(function(){
							
								taxa = jQuery(this).attr('data-taxonomy');
								
								selected_texa += taxa+',';
								
								urlval=jQuery(this).attr('datam');
																
								varsm['a' + taxa] +=","+urlval;
									
								var uniqueList2 = varsm['a' + taxa].split(',').filter(function(item,i,allItems){
									
									return i == allItems.indexOf(item);
									
								}).join(',');
																	
								foo[taxa]=uniqueList2;
									
							});
							
						}
						
						else{
							
							var mtaxa = jQuery(this).attr('data-taxonomy');	
							
							foo[mtaxa] = "";
													
						}
						
						check=jQuery(this).attr('datam');
						
						check_taxonomy=jQuery(this).attr('data-taxonomy');
						
						var strx   = name.split('-');
							
						//check the value of click already in uniqueNames array or not
						
						if(jQuery.inArray(check, uniqueNames) !== -1){
							
							uniqueNames = jQuery.grep(uniqueNames, function(value) {
								
								return value != check;
							
							});
							
						}
						
						else{
									
							uniqueNames.push(check);
								
						}
						
						arrayN=[];
						
						arrayD=[];
						
						var variations='';
						
						var attr_val='';
						
						var variaton='';
						
						var vars = {};
						
						var purl='';
						
						var orurl='';
						
						var andurl='';
						
						var numbersArray =[];
						
						// create 2D array and insert  uniquenames value and its attribute
						
						for(var i=0; i<=uniqueNames.length;i++)
						{
							var myattrc='.'+uniqueNames[i];
							 
							attr_val=jQuery(myattrc).attr('data-taxonomy');
							
							variaton=uniqueNames[i];
							
							arrayD.push([attr_val, variaton]); 
						
						}
						
						arrayD  = arrayD.slice(0, -1);
						
						for(var j = 0; j<=arrayD.length-1;j++){
							
							myattrc='.'+arrayD[j][1];
							 
							attr_val = jQuery(myattrc).attr('data-taxonomy');
							
							variations = jQuery(myattrc).attr('datam');
							
							if(jQuery.inArray(attr_val, arrayM) !== -1){
													
							}
							
							else{
									
								arrayM.push(attr_val);
								
							}
						
							if(jQuery.inArray(attr_val, arrayD[j][0]) !== -1){
									
								arrayN[attr_val] = arrayD[j][1];
									
							}
								
							else{
								
								//if unidque  on click means first time 
									
								arrayN[attr_val] = arrayD[j][1];
									
								vars['a' + attr_val] +=","+arrayD[j][1];
								
								arrayN[attr_val]=vars['a' + attr_val];
								
							}
							
						}
						
						if(selected_texa != ''){
							
							numbersArray = selected_texa.split(',');
							
						}
						
						var numbersArraya=[];
						
						jQuery.each(numbersArray, function( index, value ) {
							
							if(jQuery.inArray(value, numbersArraya) === -1){
								
								numbersArraya.push(value);
							} 
							
						});
											 
						numbersArraya = $.grep(numbersArraya,function(n){
							
							return(n);
						
						});
						
						var uniqueList2222 = '';
							 
							var valuu = '';
									
							for(var j = 0; j<=numbersArraya.length-1;j++){
								
								var jojo = numbersArraya[j];
														 
								foo[jojo]=foo[jojo].replace('undefined,','');
		 
								if(foo[jojo] != 'undefined'){
									
									var selected_cat = jQuery(this).attr('data-taxonomy');
									
									var selected_val = jQuery(this).attr('datam');
									
									if(disp_typem == "radio" && jojo == selected_cat ){
										
										foo[jojo] = '';
										
										foo[jojo] = selected_val;
										
										valuu = foo[jojo];
										
									}
									
									else{
										
										valuu = foo[jojo];
									}
									
								}
								
								//or quaries
								
								orurl+= "filter_"+numbersArraya[j]+"="+valuu+"&"+'query_type_'+numbersArraya[j]+'=or&';
								
								orurl=orurl.replace('undefined,','');
								
								orurl=orurl.replace('undefined','');
								
								orurl=orurl.replace(' ','-');
								
								// and quaries
								
								andurl+="filter_"+numbersArraya[j]+"="+valuu+"&";
								
								andurl=andurl.replace('undefined,','');
								
								andurl=andurl.replace('undefined','');
								
								andurl=andurl.replace(' ','-'); 
								
								if( valuu == ''){
									
									andurl = '';
									
									orurl = '';
								}
								
							} 
							
							// url for ajax
							
							var ajaxurl='<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>';
							
							if (ur=='OR') {
									
								var target_url=ajaxurl+'?'+orurl;
										
								if (history.pushState) {
									
									var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?'+orurl;
									
									window.history.pushState({path:newurl},'',newurl);
								}
							}
							
							else {
								
								var target_url=ajaxurl+'?'+andurl;
							
								if (history.pushState) {
									
									var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?'+andurl;
									
									window.history.pushState({path:newurl},'',newurl);
								}
							
							}
							
							if(target_url != ajaxurl+'?'){
								
								jQuery.ajax({
					   
									url         : target_url, 
									
									dataType    : 'html',
									
									success     : function (response) {
																			
										var obj  = jQuery( response),
										
										product_unit = obj.find( product);

										jQuery(products).html(product_unit);
										
										jQuery('.woocommerce-result-count').html(jQuery(response).find('.woocommerce-result-count'));  // ajax count result
									
										jQuery('.woocommerce-pagination').html(jQuery(response).find('.woocommerce-pagination'));  // ajax pagination result
										
									if(jQuery(response).find(products).length == 0){
										
										
																			
										if(jQuery('.woocommerce-info').length == 0){
											
											var woocommerce_info_div = '<p class="woocommerce-info">No products were found matching your selection.</p>';
										
											jQuery('.page-title').html(woocommerce_info_div);
												
										}
										
									}
								
								}
							
							});
							
						}
							
						else{
							
							jQuery.ajax({
				   
								url         : ajaxurl, 
								
								dataType    : 'html',
								
								success     : function (response) {
									
									var obj  = jQuery( response),
									
									product_unit = obj.find(product);

									jQuery(products).html(product_unit);
									
									jQuery('.woocommerce-result-count').html(jQuery(response).find('.woocommerce-result-count'));  // ajax count result
									
									jQuery('.woocommerce-pagination').html(jQuery(response).find('.woocommerce-pagination'));  // ajax pagination result
									
									if(jQuery(response).find(products).length == 0){
										
										var woocommerce_info_div = '<p class="woocommerce-info">No products were found matching your selection.</p>';
										
											jQuery('.page-title').html(woocommerce_info_div);
												
										}
								
										
										if(jQuery('.woocommerce-info').length == 0){
											
											var woocommerce_info_div = '<p class="woocommerce-info">No products were found matching your selection.</p>';
										
											jQuery('.page-title').append(woocommerce_info_div);
												
										}
								
								}
								
							});
						
						}
							
					}
						
				});
		
		
			</script>
				
			<style>
				.prepended{color:red; font-family: WooCommerce;}
					
				.<?php echo $widget_id; ?>prepended{color:red; font-family: WooCommerce;}
					
				.active{font-family: WooCommerce;}
					
			</style>	
				
				<?php 
		}
			
		echo $args['after_widget'];
	}
	
	// display content on backend

	public function form( $instance ) {
		
		
		
		$array = wc_get_attribute_taxonomies(); 
		?>
		
		<p>
			<label><?php _e('Title','phoen-ajax-product-Filter'); ?></label>
			
			<input type="text" value="<?php echo isset($instance['title']) ? $instance['title'] : ''; ?>" name="<?php echo $this->get_field_name( 'title' ); ?>"   class="widefat phoen_ajax_filter_title ">
			
		</p>
			
		<li>
		
			<div class="phoeniixx_display_type">
			
				<label><?php _e('Display type','phoen-ajax-product-Filter'); ?></label>
				 
				<?php $disp_type = (isset($instance['disp_type'])) ? $instance['disp_type'] : ''; ?>
				
				<select name="<?php echo $this->get_field_name( 'disp_type' ); ?>"  id="<?php echo $this->get_field_id( 'disp_type' ); ?>" class="disp_type   <?php echo $this->get_field_id('disp_type'); ?>">
						
					<option value="radio" <?php if($disp_type=='radio') echo 'selected';?>><?php _e('Radio','phoen-ajax-product-Filter');?></option>	
				
					<option value="link" <?php if($disp_type=='link') echo 'selected';?>><?php _e('Link','phoen-ajax-product-Filter');?></option>	
					
					<option value="color" <?php if($disp_type=='color') echo 'selected';?>><?php _e('Color','phoen-ajax-product-Filter');?></option>
					
					<option value="Selectbox" <?php if($disp_type=='Selectbox') echo 'selected';?>><?php _e('Selectbox','phoen-ajax-product-Filter');?></option>	
												
					<option value="Checkbox" <?php if($disp_type=='Checkbox') echo 'selected';?>><?php _e('Checkbox','phoen-ajax-product-Filter');?></option>	
					
				</select>
			
			</div>
			
			<div  class="attributec"><label><?php _e('Attribute','phoen-ajax-product-Filter'); ?></label>
			
				<select  name="<?php echo $this->get_field_name( 'attribute' ); ?>" id="<?php echo $this->get_field_id( 'attribute' ); ?> attribute"  class="attrib">
				
					<?php 
				
				foreach($array as $key => $value){
					$disp_type = (isset($instance['attribute'])) ? $instance['attribute'] : ''; ?>
						<option value="<?php echo $value->attribute_name ;?>" <?php if($disp_type==$value->attribute_name) echo 'selected';?>><?php echo $value->attribute_label;?></option>
					
					<?php 
				}
					?>
				</select>
				
			</div>
	
			<?php 
			
			for($i=0;$i<count($array);$i++){ 
			
				$att="pa_".$array[$i]->attribute_name;
				
				$attm=$array[$i]->attribute_name;
			
				$argn = array(
								'hide_empty' => false
							);

				$terms = get_terms($att, $argn);
			
				foreach($terms as $val){
					
					$vname=$val->name; 
					
					if($disp_type==='color' && $disp_type1===$array[$i]->attribute_name){
						?>
					<div class="<?php echo $array[$i]->attribute_name; ?> phoeniixx_variation  <?php echo $this->get_field_id($attm); ?>" >
					
						<p class="phoeniixx_variation_product_name"><?php echo strtoupper($val->name); ?></p>
					
						<input type="text" name="<?php echo $this->get_field_name($vname); ?>" value="<?php echo isset($instance[$vname])?$instance[$vname]:''; ?>"class="ajaxcolorpicker color-picker ttattrib" >
					
					</div>
				
					<?php 
					}else{
						?>
							<div class="<?php echo $array[$i]->attribute_name; ?> phoeniixx_variation  <?php echo $this->get_field_id($attm); ?>"  style="display:none;"><p class="phoeniixx_variation_product_name"><?php echo strtoupper($val->name); ?></p>
					
						<input type="text" name="<?php echo $this->get_field_name($vname); ?>" value="<?php echo isset($instance[$vname])?$instance[$vname]:''; ?>"class="ajaxcolorpicker color-picker ttattrib" >
					
					</div>
					<?php }
				}  
				$disp_name = (isset($instance['disp_type'])) ? $instance['disp_type'] : ''; 
			 
				$variation_name = (isset($instance['attribute'])) ? $instance['attribute'] : ''; 
				
			} 	?>	
				
				
				<input type="hidden" value="<?php echo $disp_name; ?>" class="disp_name <?php echo $this->get_field_id('disp_name'); ?>">
			
				<input type="hidden" value="<?php echo $variation_name; ?>" class="variation_name <?php echo $this->get_field_id('variation_name'); ?>">
		</li> 
		
		<p>
		
			<label><?php _e('Query type','phoen-ajax-product-Filter'); ?></label>
			
			<?php $query_type = (isset($instance['query_type'])) ? $instance['query_type'] : ''; ?>
			
			<select name="<?php echo $this->get_field_name( 'query_type' ); ?>" class="widefat ">
			
				<option value="AND" <?php if($query_type=='AND') echo 'selected';?>><?php _e('AND','phoen-ajax-product-Filter');?></option>
				
				<option value="OR" <?php if($query_type=='OR') echo 'selected';?>><?php _e('OR','phoen-ajax-product-Filter');?></option>	
				
			</select>
		</p>

		
		<script>

		jQuery(document).ready(function($) {
			
			 // jQuery('.ajaxcolorpicker').wpColorPicker();	

			jQuery('.ajaxcolorpicker').on('focus', function(){
							var parent = jQuery(this).parent();
							jQuery(this).wpColorPicker()
							parent.find('.wp-color-result').click();
						}); 
			

			jQuery('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();
			
			jQuery(document).ajaxComplete(function() {
				jQuery('#widgets-right .color-picker, .inactive-sidebar .color-picker').wpColorPicker();
			});			 
			
			var wid_id='';
			 						
			wid_id="widget-"+jQuery('.myidv').val()+"-";
				
			var disp_type="widget-"+jQuery('.myidv').val()+"-disp_type";
			
			var dipml='".'+disp_type+' option:selected'+'"';
			
			var attrib=".widget-"+jQuery('.myidv').val()+"-attrib";
			
			var vali=".widget-"+jQuery('.myidv').val();
			
			var disp_name=".widget-"+jQuery('.myidv').val()+"-disp_name";
			
			var variation_name=".widget-"+jQuery('.myidv').val()+"-variation_name";
			
			//jQuery('.panel-dialog .ajaxcolorpicker').wpColorPicker();	
			var disp_name1=jQuery(disp_name).val();
			 
			var variation_name1="."+jQuery(variation_name).val();
			
			var jojo ='';
			
			jojo =variation_name1;
			
			jQuery( '.ttattrib' ).each( function( index ) {
				
				if( jQuery(this).val() ) {
						
						jQuery(this).parent().show();
					}
				});
				
			var empty="";
			
			jQuery('.attrib').change(function(){
				
				var dip = jQuery(this).parents('li').find('.disp_type').val();	
				
				var attr=jQuery(this).val();
							
				if(dip == 'color'){
				
					jQuery(this).closest('li').find('.phoeniixx_variation').hide();
					
					var jojo="."+attr;
					
					jQuery(this).closest('li').find(jojo).show();
					
				}
				
				else{
					
					jQuery(this).closest('li').find('.phoeniixx_variation').hide();
				}
				
			});
		
			jQuery('.disp_type').change(function(){
															
				var cval = jQuery(this).val();
				
				if(cval == 'color')
				{
				
					jQuery(this).closest('li').find('.attrib option:first-child').attr("selected", "selected");
				
					var n=	jQuery(".attrib option:first").val();
				
					jQuery(this).closest('li').find('.phoeniixx_variation').hide();
																						
					var mnm= "."+n;
						 
					jQuery(this).closest('li').find(mnm).show();
							
				}
				
				else{
						
					jQuery(this).closest('li').find('.phoeniixx_variation').hide();
				}
											
				if(cval != 'color') {
								
					jQuery(this).closest('li').find('.phoeniixx_variation').hide();
						 
				}
				
			}); 
				
		});
		
		</script>
	
		<style>
	
			.phoeniixx_variation {
				
				line-height:24px;
				
				float: left;
				
				width: 100%;
				
				margin:5px 0;
				
			}
			
			ul 	{
				
				list-style-type: none;
				
			}
			
			li 	{
				
			list-style-type: none;
			
			}

			
			.phoeniixx_variation .wp-picker-container {
				
				vertical-align:top;
				
			}
			
			.phoeniixx_variation p.phoeniixx_variation_product_name {
				
				display: inline-block;
				
				margin:0;
				
				width:25%;
				
			}
			
			.attributec label {
				
				display: inline-block;
				
				width: 25%;
				
			}
			
			.attributec {
				
				margin-bottom: 15px;
				
				margin-top: 5px;
				
			}
			
			.phoeniixx_display_type label {
				
				display: inline-block;
				
				width: 25%;
				
			}
			
		
		</style>
							
	
		<?php
		
	}
	

	
	// Save data in database
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
	
		$instance['title']=strip_tags( $new_instance['title'] );
		
		$instance['attribute']=strip_tags( $new_instance['attribute'] );
		
		$instance['query_type']=strip_tags( $new_instance['query_type'] );
		
		$instance['disp_type']=strip_tags( $new_instance['disp_type'] );
		
		$array = wc_get_attribute_taxonomies(); 
		
		for($i=0;$i<count($array);$i++) { 
							
			$att="pa_".$array[$i]->attribute_name;
			 
			$argn = array(
			
				'hide_empty' => false
				
			);
				
			$terms = get_terms($att,$argn);
			
			foreach($terms as $val){
				
				$vname=$val->name;
				
				if($new_instance['disp_type']=='color')	{
					
					$instance[$vname]=strip_tags( $new_instance[$vname] );
				}
				
				else{
					
					$instance[$vname]="";
					
				}
					
			} 
					
		} 
	
		return $instance;
	
	}
	
//end of class	
}

	function load_color_picker_style() {
		
		wp_enqueue_style('wp-color-picker');
		
	}
	
	function load_color_picker_script() {
		
		wp_enqueue_script('wp-color-picker');
	}

	add_action('admin_print_scripts-widgets.php', 'load_color_picker_script');

	add_action('admin_print_styles-widgets.php', 'load_color_picker_style');

	function Ajax_Product_Filter_register_widget() {

		register_widget( 'Ajax_Product_Filter' );

	}

	function spice_get_widget_id($widget_instance) {
		
		// Check if the widget is already saved or not. 
		
		if ($widget_instance->number=="__i__"){ ?>
		 
			<div class="widget ui-draggable"  id="widget-6_my_widget-10"></div>
			
			<?php 
		}  
		
		else {	   ?>
		  
		  <input type="hidden" class="myidv" value="<?php echo $widget_instance->id; ?>">   
		<?php 
		
		}
	}
	
	add_action( 'widgets_init', 'Ajax_Product_Filter_register_widget' );

	add_action('in_widget_form', 'spice_get_widget_id');
	
?>