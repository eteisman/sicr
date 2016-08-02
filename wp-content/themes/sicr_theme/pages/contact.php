<?php
/*
Template Name: Contact
*/
?>
<?php get_header(); ?>
<style>
dd {
	margin: 0 0 0px;
}
address {
	margin-bottom: 16px;
}
</style>
	<div class="grid_8">
		<div class="box1">
			<div class="title_box m_14">
				<h4>
					Contact <span> Information</span>
				</h4>
			</div>
			<div class="wrapper" style="margin-bottom: 32px;">
				<div class="map">
					<figure class="map_box img_thumbnail">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2461.0565751799745!2d4.479517899999999!3d51.9146789!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c433607ca4da2f%3A0xd22b1dfca65428f4!2sSchiedamse+Vest+121%2C+3012+BH+Rotterdam!5e0!3m2!1sen!2snl!4v1420665374766" style="border:0"></iframe>									  
					</figure>
				</div>
				
				<div class="address_box">
					<h6 class="italic">Scots International Church Rotterdam</h6>
					<address>
						<dl>
							<dt>
								Schiedamsevest 121 <br/> 
								3012 BH, Rotterdam											
							</dt>
							<dd>
								<i class="fa fa-whatsapp" style="font-size: 1.2em; margin-right: 8px;"></i>
								<a href="tel:31104124779">+31 (0)10 412 4779</a>
							</dd>
							<dd class="mail">							
								<i class="fa fa-envelope-o" style="font-size: 1.2em; margin-right: 8px;"></i>
								<a href="emailto:info@scotsintchurch.com">info@scotsintchurch.com</a>
							</dd>
							<dd class="Facebook">
								<i class="fa fa-facebook-official" style="font-size: 1.2em; margin-right: 8px;"></i>
								<a target="_blank" href="https://www.facebook.com/pages/Scots-International-Church-Rotterdam/230829440267585" >Facebook</a>							
							</dd>
						</dl>
					</address>
					
					<div>
					The church is opposite to Rotterdam&lsquo;s Eye-Hospital (Het Oogziekenhuis).
					<div style="height: 4px;"></div>
					The nearest tram or metro can be found at Leuvehaven.
					<div style="height: 4px;"></div>
					The church is within easy walking distance of the Maritime Museum and the Erasmus Bridge.
					</div>
					<!--  second address, removed by ET
					<address>
						<dl>
							<dt>
								9863 - 9867 Mill Road, Cambridge, MG09 99HT.
							</dt>
							<dd><span> Freephone:</span> +1 800 559 6580</dd>
							<dd><span>Telephone:</span> +1 800 603 6035</dd>
							<dd><span>FAX:</span>+1 800 889 9898</dd>
							<dd class="mail">E-mail: <a href="#">mail@demolink.org</a></dd>
						</dl>
					</address>
					-->
				</div>
			</div>
		</div>
	</div>
	<div class="grid_4">
		<div class="box1">
		
			<div class="title_box m_14">
				<h4>
					Contact 
					<span>  Form</span>
				</h4>
			</div>
			<form id="form">
				<div class="success_wrapper">
					<div class="success-message">Contact form submitted</div>
				</div>
				<label class="name">
				<input type="text" placeholder="Name" data-constraints="@Required @JustLetters" />
				  <span class="empty-message">*This field is required.</span>
				  <span class="error-message">*This is not a valid name.</span>
				  </label>
				
				  <label class="email">
				  <input type="text" placeholder="E-mail" data-constraints="@Required @Email" />
				  <span class="empty-message">*This field is required.</span>
				  <span class="error-message">*This is not a valid email.</span>
				  </label>
				  <label class="phone">
					  <input type="text" placeholder="Phone" data-constraints="@JustNumbers"/>
					  <span class="error-message">*This is not a valid phone number.</span>
				  </label>
				
				  <label class="message">
				  <textarea placeholder="Message" data-constraints='@Required @Length(min=10,max=999999)'></textarea>
				  
				  <span class="empty-message">*This field is required.</span>
				  <span class="error-message">*The message is too short.</span>
				  </label>
				  <div>
					
					<div class="wrapper">
					  <div class="btns">
						 <a data-type="reset" class="btn resrt">
							<span>Clear</span>
						 </a>
						 
					  </div>
					  <div class="btns mr_0">
						<a data-type="submit" class="btn">
							<span>Send</span>
						</a>
						
					  </div>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php get_footer(); ?>