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
			{{--@dd($results)--}}
			@foreach($results['folders'] as $folder)
				<li class="objectListItem isFolder">
					@include('partials/html/folder', ['id' => $folder->id, 'name' => $folder->name])
				</li>
			@endforeach

			@foreach($results['articles'] as $article)
				<li class="objectListItem isFolder">
					@include('partials/html/file', ['id' => $article->ID, 'title' => $article->Title ])
				</li>
			@endforeach
		</ul>
	@endif
</div>

<script>
	
</script>
<script>
	$(document).ready(function(){

		$('body').click(function(e){
			$('.objectAnchor').removeClass('selected');
		});

		$('.articleGUI').on('click', '.objectAnchor', function(e){
			e.preventDefault();
			e.stopPropagation();
			$('.objectAnchor').removeClass('selected');
			$(this).addClass('selected');
		})

		$('.articleGUI').on('click', '.folderPath a', function(e){
			e.preventDefault();

			var url = $(this).attr('href');

			__getAjax(url);
		});

		$('.articleGUI').on('dblclick', '.fa-folder', function(){
			
			var folderId = $(this).closest('.objectAnchor').data('id');
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