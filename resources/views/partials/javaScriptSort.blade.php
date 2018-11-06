
<script>

	$('.ASC, .DESC').click(function(e){
		e.preventDefault();

		$('.ASC, .DESC').each(function(i,e){
			$(this).removeClass('active');
		});

		$(this).addClass('active');

	
		var param = $(this).closest('.sortArrow').data('param');
		var dir = e.target.classList.item(0);
		var action = $(this).closest('.collatedGridHeader').data('action');
		var srchTrm = $(this).closest('.collatedGridHeader').data('srchtrm');
		
		var url = action + "/" + param + "/" + dir;
		url +=  srchTrm?"/" + srchTrm:"";
		console.log(url);

		try{
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		     	url : url,
		      	type : "GET",
		      	//data : {action: 'refresh'},

		      	failure: function(response){
		      		console.log(response);
		      	},

		        success: function(response){
		            $('.collatedGrid.noSort').empty();
		            var contents = $(response).filter('.collatedGrid.sorted').html();
		            if(contents == null){
		            	contents = $(response).find('.collatedGrid.sorted').html();
		            }
		            console.log(contents);
		            $('.collatedGrid.noSort').append(contents);
		    	},
			});
		}catch(e){
			console.log(e);
		}
	});
</script>