<h1>ARTICLE GUI</h1>

<div class="articleGUI">
	<div class="folderPath">
		<a href="{{url('articleGUI')}}">Home</a>
		@foreach($pathArr as $key => $path)
			<i class="fas fa-angle-right"></i>
			<?php end($pathArr); ?>
			@if ($key !== key($pathArr))
				<a href="{{url('articleGUI')}}/{{$path['id']}}">{{$path['name']}}</a>
			@else
				{{$path['name']}}
			@endif			
		@endforeach
	</div>

	@if(!count($results))
		<h2>No results</h2>
	@else
		<ul>
			@foreach($results['folders'] as $folder)
				<li class="fileOrFolder" data-id="{{$folder->id}}">
					<i class="fas fa-folder"></i><br>
					<span class="itemTitle">{{$folder->name}}</span>
				</li>
			@endforeach

			@foreach($results['articles'] as $article)
				<li class="fileOrFolder" data-id="{{$article->ID}}">
					<i class="far fa-file"></i><br>
					<span class="itemTitle">{{$article->Title}}</span>
				</li>
			@endforeach
		</ul>
	@endif
</div>

<script>
	$('.fileManager').on('dblclick', '.fa-file', function(){
		var fileId = $(this).closest('.fileOrFolder').data('id');
		var url = 'readArticle/' + fileId;

		location.href = url;
	});
</script>
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