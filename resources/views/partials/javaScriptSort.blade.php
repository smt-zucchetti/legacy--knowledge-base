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

	var uriSegment;
	<?php if($type == 'articles'){ ?>
		uriSegment = 'sortArticles';
	<?php }else{ ?>
		uriSegment = 'sortCategories';
	<?php } ?>

	var url = uriSegment + "/" + param + "/" + dir;

	console.log(url);

	$.ajax({
     	url : url,
      	type : "GET",
      	//data: data,
      	data : {action: 'refresh'},

      	failure: function(response){
      		console.log(response);
      	},

        success: function(response){
        	//alert('11');
        	console.log(response);
            $('.collatedGrid.noSort').empty();
            $(response).find('.collatedGrid.sorted > *').appendTo('.collatedGrid.noSort');		            
    	},
	});
});