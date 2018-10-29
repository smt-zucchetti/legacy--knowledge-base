
<script>

	$('.sortArrow').click(function(e){
		e.preventDefault();

		$('.sortArrow').not(this).each(function(i,e){
			$(this).removeClass('down');
			$(this).removeClass('up');
		});

		if(e.target.classList[0] == "upArrow"){
			$(this).removeClass('down');
			$(this).addClass('up');
		}else if(e.target.classList[0] == "downArrow"){
			$(this).removeClass('up');
			$(this).addClass('down');
		}

		var param = $(this)[0].classList[1];

		var dir;
		if($(this).hasClass('up')){
			dir = "ASC";
		}else{
			dir = "DESC";
		}

		var uriSegment = $(this).data('method');

		
		var searchTerm;
		<?php if(!empty($searchTerm)){ ?>
			searchTerm = "<?php echo $searchTerm ?>";
		<?php }else{ ?>
			searchTerm = null;
		<?php } ?>


		var url = uriSegment + "/" + param + "/" + dir;

		if(searchTerm){
			url += '/' + searchTerm;
		}

		console.log(url);

		try{
			$.ajax({
		     	url : url,
		      	type : "GET",
		      	//data: data,
		      	data : {action: 'refresh'},

		      	failure: function(response){
		      		console.log('asdasd');
		      		console.log(response);
		      	},

		        success: function(response){
		            $('.collatedGrid.noSort').empty();
		            $(response).find('.collatedGrid.sorted > *').appendTo('.collatedGrid.noSort');		            
		    	},
			});
		}catch(e){
			console.log(e);
		}
	});
</script>