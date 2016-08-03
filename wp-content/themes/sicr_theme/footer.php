<?php include_once "library.php" ?>
<?php if (FALSE) {?>
				<!-- sidebar -->
				<div class="grid_4">					
					<?php include 'index-right.php';?>					
				</div>
				<!-- sidebar -->
<?php }?>				
			</div> 		<!-- class="row" -->
		</div> 			<!-- class="container" -->
	</div>				<!-- id="content" -->
	<!--======================== footer ============================-->
	<!--======================== footer ============================-->
	<footer>
		<div class="container">
			<div class="row">
				<div class="grid_2 m_20">
					<h4 class="footer_title">Worship</h4>
					<ul class="list">
						<li>Main Service<br/><a href="#">Sundays, 10:30am</a></li>						
						<li>Minister<br/><a href="#">Rev. Derek Lawson</a></li>
						<li>Kerkdienst gemist<br/><a target="_blank" href="http://kerkdienstgemist.nl/assets/733518">kerkdienstgemist.nl</a></li>						
					</ul>
				</div>
				<div class="grid_2 m_20">
					<h4 class="footer_title">Information	</h4>
					<?php
					$lstHerald = get_the_herald_list( get_sicr_root_dir() );
					$latestHerald = $lstHerald[1]["items"][1];
					
					$lstSheets = get_service_sheet_list( sicr_root_dir() );
					$latestSheet = $lstSheets[1]["items"][1];
					
					$secondLatestSheet = $lstSheets[1]["items"][2]; 
					
					?>
					<ul class="list">
						<li>Our Church Magazine<br/><a href="<?php echo $latestHerald["link"];?>">The Herald</a></li>
						<li>Service sheet<br/>
						<a href="<?php echo $latestSheet["link"];?>">Service sheet</a>
						<?php if ( have_two_service_sheets() ) :?>
						<br/><a href="<?php echo $secondLatestSheet["link"];?>">Service sheet (2)</a>
						<?php endif; ?>
						</li>
						<li>Facebook<br/><a target="_blank"  href="https://www.facebook.com/pages/Scots-International-Church-Rotterdam/230829440267585"><img src="<?php echo sicr_image_dir();?>/asset_f_logo_sm.png" alt="facebook" width="24" height="24"/></a></li>
					</ul>
				</div>				
				<div class="grid_2 m_20">
					<h4 class="footer_title"></h4>
					<ul class="list">
						<li><a href="#"></a></li>
					</ul>
				</div>
				<div class="grid_2 m_20">
					<h4 class="footer_title"></h4>
					<ul class="list">
						<li><a href="#"></a></li>
					</ul>
				</div>
				
				<div class="grid_4">
					<a class="footer_logo" href="<?php echo sicr_slug_url('home')?>"><img src="<?php echo sicr_image_dir();?>/sicr_logo_large_transparent.png" alt="" style="height: 120px; width: 100x;">
					<h6 class="logo">
					Scots International<br/>&nbsp;&nbsp;Church <span class="logo">Rotterdam</span></h6>													
					</a>
					
					<span class="footer_addres">Schiedamsesingel 2, 3012 BA, Rotterdam </span>
					<span class="footer_phone">
					  <i class="fa fa-whatsapp" style="top: 2px;"></i>
					  <a href="tel:31104124779">+31 (0)10 412 4779</a>
					 </span>
					<span class="footer_phone">
					  <i class="fa fa-envelope-o" style="top: 1px;"></i>
					  <a href="mailto:info@scotsintchurch.com">info@scotsintchurch.com</a></span>
					
				</div>
			
			
			
			</div>
		
			<div class="row">
				<div class="grid_12">
					<div class="copyright">Scots International Church Rotterdam &copy; <span id="copyright-year"></span>
						<a target="_blank" href="<?php echo admin_url(); ?>" style="margin-left: 48px;">Admin</a>						
					</div>
					<div class="footer-link"></div>
				</div>
			</div>
		</div>
	</footer>
	<!--======================== footer ============================-->
<script>
	var refTagger = {
		settings: {
			bibleReader: "bible.faithlife",
			bibleVersion: "ESV",			
			socialSharing: [],
			customStyle : {
				heading: {
					backgroundColor : "#ffffff",
					color : "#0072C6"
				},
				body   : {
					color : "#333376",
					fontFamily : "Verdana, Geneva, sans-serif",
					moreLink : {
						color: "#0072C6"
					}
				}
			}
		}
	};
	
	(function(d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = "//api.reftagger.com/v2/RefTagger.js";
		s.parentNode.insertBefore(g, s);
	}(document, "script"));
	
</script>		
	
	<!--======================== footer ============================-->	
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-67503347-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php wp_footer();?>
</body>
</html>