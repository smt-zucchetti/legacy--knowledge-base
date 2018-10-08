<h1>ARTICLE GUI</h1>


	
@if(!count($folders))
	<h2>No results</h2>
@else

	<div class="articleTree">

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
		<ul>
			@foreach($folders as $folder)
				@if($folder->folderId === null || $curFolderId == $folder->folderId)
					<?php
						$articleTitlesArr = explode(",", $folder->articleTitles);
						$articleIdsArr = explode(",", $folder->articleIds);
					?>

					@for($i = 0; $i < count($articleTitlesArr); $i++)
						<li class="fileOrFolder" data-id="{{$articleIdsArr[$i]}}">
							<i class="far fa-file"></i><br>
							<span class="itemTitle">{{$articleTitlesArr[$i]}}</span>
						</li>
					@endfor
				@else
					<li class="fileOrFolder" data-id="{{$folder->folderId}}">
						<i class="fas fa-folder"></i><br>
						<span class="itemTitle">{{$folder->folderName}}</span>
						<ul>
							@foreach(explode(',', $folder->articleTitles) as $articleTitle)
								<li>{{$articleTitle}}</li>
							@endforeach
						</ul>
					</li>
				@endif
			@endforeach
		</ul>
	</div>
@endif

<script>
	$(document).ready(function(){

		$('body').click(function(evt){
			$('.fileOrFolder').removeClass('selected');

			if($(evt.target).hasClass('fa-folder') || $(evt.target).hasClass('fa-file')){
				$(evt.target).closest('.fileOrFolder').addClass('selected');
			}
		});

		$('.articleTree').on('click', '.folderPath a', function(e){
			e.preventDefault();

			var url = $(this).attr('href');

			__getAjax(url);
		});

		$('.articleTree').on('dblclick', '.fa-folder', function(){
			
			var folderId = $(this).closest('.fileOrFolder').data('id');
			var url = 'articleGUI/' + folderId;			

			__getAjax(url);
		});

		$('.articleTree').on('dblclick', '.fa-file', function(){
			
			var fileId = $(this).closest('.fileOrFolder').data('id');
			var url = 'readArticle/' + fileId;

			location.href = url;
		});


		function __getAjax(url){

			$.ajax({
		     	url : url,
		      	type : "GET",

		      	failure: function(response){},
		      	error: function (textStatus, errorThrown) {},
		        success: function(response){
		            $('.articleTree').empty();
		            $(response).find('.articleTree > *').appendTo('.articleTree');		            
		    	},
			});
		}

		
	});

</script>