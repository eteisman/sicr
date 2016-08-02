<script>
  function sicrSearchWordPress() {
	  document.forms['searchform'].submit();
  }  
</script>
<form role="search" method="get" id="searchform" name="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-box">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />		
		<a href="javascript:sicrSearchWordPress();" class="more-link"><span>Search</span></a>		
	</div>
</form>