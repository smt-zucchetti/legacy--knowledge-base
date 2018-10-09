<h1>ARTICLE GUI</h1>


	

	<div class="articleGUI">

		<div class="folderPath">
			<a href="{{url('/articleGUI')}}">Home</a>
			@foreach($pathArr as $key => $path)
				<i class="fas fa-angle-right"></i>
				<?php end($pathArr); ?>
				@if ($key !== key($pathArr))
					<a href="{{url('/articleGUI')}}/{{$path['id']}}">{{$path['name']}}</a>
				@else
					{{$path['name']}}
				@endif			
			@endforeach
		</div>

		@if(!count($folders))
			<h2>No results</h2>
		@else
			<ul>
				@foreach($folders as $folder)
						
						<li class="fileOrFolder" data-id="{{$folder->folderId}}">
							<i class="fas fa-folder"></i><br>
							<span class="itemTitle">{{$folder->folderName}}</span>
							<ul>
								@foreach(explode(',', $folder->articleTitles) as $articleTitle)
									<li>{{$articleTitle}}</li>
								@endforeach
							</ul>
						</li>

						<?php
							$articleTitlesArr = ($folder->articleTitles !== null)?explode(",", $folder->articleTitles):array();
							$articleIdsArr = ($folder->articleIds !== null)?explode(",", $folder->articleIds):array();
						?>

						@for($i = 0; $i < count($articleTitlesArr); $i++)
							<li class="fileOrFolder" data-id="{{$articleIdsArr[$i]}}">
								<i class="far fa-file"></i><br>
								<span class="itemTitle">{{$articleTitlesArr[$i]}}</span>
							</li>
						@endfor
				@endforeach
			</ul>
		@endif
	</div>


<script>
	$(document).ready(function(){

		$('body').click(function(evt){
			$('.fileOrFolder').removeClass('selected');

			if($(evt.target).hasClass('fa-folder') || $(evt.target).hasClass('fa-file')){
				$(evt.target).closest('.fileOrFolder').addClass('selected');
			}
		});

		$('.articleGUI').on('click', '.folderPath a', function(e){
			e.preventDefault();

			var url = $(this).attr('href');

			__getAjax(url);
		});

		$('.articleGUI').on('dblclick', '.fa-folder', function(){
			
			var folderId = $(this).closest('.fileOrFolder').data('id');
			var url = 'articleGUI/' + folderId;			

			__getAjax(url);
		});


		function __getAjax(url){

			$.ajax({
		     	url : url,
		      	type : "GET",

		      	failure: function(response){},
		      	error: function (textStatus, errorThrown) {},
		        success: function(response){
		            $('.articleGUI').empty();
		            $(response).find('.articleGUI > *').appendTo('.articleGUI');		            
		    	},
			});
		}

		
	});

</script>