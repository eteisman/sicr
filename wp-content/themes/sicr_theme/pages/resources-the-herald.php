<?php
/*
Template Name: Resources - The Herald
*/
?>
<?php get_header(); 
    // load the list of "The Herald" issues from the /herald directory
	$list = get_the_herald_list( sicr_root_dir() );
	$latestItem = $list[1]["items"][1];
?>
	<style>
	  ul.what-we-have-to-offer {list-style-type: disc; padding-left: 24px;}
	  ul.what-we-have-to-offer li {line-height: 2em;}
	  
	  ul.our-heritage {list-style-type: disc; padding-left: 24px;}
	  ul.our-heritage li {line-height: 2em;}						  
	  ul.our-heritage li a {color: #0072C6;}
	</style>				
	
	<div class="grid_8">
		<div class="box1 pdf_viewer" >
			<h6 class="italic"style="float: right;" >
				<a target="_blank" href="<?php echo $latestItem["link"];?>">Open in full window</a>
			</h6>
			<div class="title_box m_14">
				<h4>
					The<span> Herald</span>
				</h4>
			</div>
			<div class="wrapper">
			<iframe src = "<?php echo get_template_directory_uri();?>/js/ViewerJS/#<?php echo $latestItem["link"];?>" width='100%' height='800px'></iframe>
			</div>
		</div>
	</div>
	<div class="grid_4">					
		<div class="box2">
			<div class="title_box">
				<h4>
					Other <br> <span>Information</span>
				</h4>
			</div>						
			<h6 class="italic">
				<i class="fa fa-star-o" style="font-size: 1.2em; margin-right: 8px; margin-top: -0px;"></i>
				<a target="_blank" href="http://kerkdienstgemist.nl/assets/733518" >Kerkdienst gemist</a>
			</h6>
			<h6 class="italic">
				<i class="fa fa-bookmark-o" style="font-size: 1.2em; margin-right: 8px; margin-top: -0px;"></i>
				<a href="<?php echo sicr_slug_page("service-sheets"); ?>" >Service sheets</a>
			</h6>						
			<h6 class="italic">
				<i class="fa fa-facebook-official" style="font-size: 1.2em; margin-right: 8px; margin-top: -0px;"></i>
				<a target="_blank" href="https://www.facebook.com/pages/Scots-International-Church-Rotterdam/230829440267585" >Facebook</a>
			</h6>																														
		</div>
		
		
		<div class="box1">
			<div class="title_box">
				<h4 id="services-title">
					Older <span>Editions</span>
				</h4>
			</div>
			<div class='title_box' style='display: table;'>
			<?php
			$groupSize = 5;
			foreach ($list as $groupKey=>$group) {
				$groupName = $group["name"];
				$groupItems = $group["items"];
				$btnGroup = round($groupKey/$groupSize)+1;
				$btnPrev = $btnGroup-2;
				$btnCurr = $btnGroup-1;
				$btnNext = $btnGroup;
				$btnVisible = ($btnGroup ==1)? 'block' : 'none';
				
				if ($groupKey%$groupSize == 1) {
					echo "<div id='item-group-$btnGroup' style='display: $btnVisible;'>";	
				}
				echo "	  <h6 class='icon_title'>$groupName</h6>";	
				
				foreach ($groupItems as $itemKey=>$item) {
					$itemLink = $item["link"];
					$itemName = $item["name"];
					echo "
					<div style='float: left;'>
						<i class='fa fa-file-pdf-o' style='font-size: 1.2em; margin-left: 12px;'></i>
						<a style='margin: 4px 8px 4px 8px;' href='$itemLink'>$itemName</a>
					</div>								
					";							
					if ($itemKey %2 == 0) {
						echo "<div style='clear: both;'></div>";
					}
				}
				echo "<div style='clear: both;'></div>";
				if ($groupKey%$groupSize == 0) {
					echo"
					<h6 id='item-group' class='items-links' style='text-align:center; margin-top: 10px; margin-bottom: 10px;'>
					  <a id='btn-previous-$btnCurr' class='btn_small' disabled='disabled'
					  href='javascript:navigateItemsPage($btnPrev);'><span style='padding-left: 14px; padding-right: 16px;'>&lt; Newer</span></a>
					  <a id='btn-next-$btnCurr' class='btn_small'  
					  href='javascript:navigateItemsPage($btnNext);'><span style='padding-left: 16px; padding-right: 14px;'>Older &gt;</span></a>		  			  			  		
					</h6>								
					";
					echo "</div>";
				}
			} 
			?>
			<script>
				function navigateItemsPage(page) {
					idPrevGroup = "#item-group-".concat(page-1);
					idCurrGroup = "#item-group-".concat(page);
					idNextGroup = "#item-group-".concat(page+1);
					
					if ($(idCurrGroup).html()) {
						$(idPrevGroup).hide();
						$(idCurrGroup).show();
						$(idNextGroup).hide();
					}
					if ($(idPrevGroup).html()) {
						jQuery("#btn-previous-".concat(page)).removeAttr('disabled');									
					} else {
						jQuery("#btn-previous-".concat(page)).attr('disabled', 'disabled');
					}
					if ($(idNextGroup).html()) {
						jQuery("#btn-next-".concat(page)).removeAttr('disabled');
					} else {
						jQuery("#btn-next-".concat(page)).attr('disabled', 'disabled');
					}
					
				}
			</script>
			</div>
		</div>				
	</div>
<?php get_footer(); ?>