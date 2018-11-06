<h1>{{ !empty($searchTerm)?'SEARCH RESULTS for "'.$searchTerm.'"':'ALL ARTICLES' }}</h1>


@include('partials/listHeader', ['type' => 'articles'])


<div class="collatedGrid {{$sorted[0] == true?'sorted':'noSort'}} {{Auth::check()?'loggedIn':''}}">

@if(count($articles) === 0)
	<h2>No results</h2>
@else
	@php($i = 0)

	@foreach($articles as $article)
		
		@php($row = $i % 2 == 0?'row odd':'row')

		<div class="{{$row}} titleRow">
			<a href="{{ url('/readArticle/'.$article->ID) }}">
				<i class="far fa-file"></i> {{$article->Title}}
			</a>
		</div>
		@if (Auth::check())
			<div class="{{$row}} actionItems">
				<div style="display: none;" id="delete-article-{{$article->ID}}">
					<form method="post" action="{{ url('/deleteArticle/'.$article->ID) }}">
						@csrf
						<h2>Delete Article "{{$article->Title}}"?</h2>
						<input type="submit" value="Delete" />
						<button class="cancelButton" type="button" data-fancybox-close="" >
							Cancel
						</button>
					</form>
				</div>
				<a data-fancybox data-src="#delete-article-{{$article->ID}}" href="javascript:;">
					<i class="fas fa-trash-alt"></i> Delete 
				</a>
				<a href="{{ url('/updateArticle/'.$article->ID) }}" >
					<i class="fas fa-pencil-alt"></i>
					Edit
				</a>
			</div>
		@endif
		<div class="{{$row}} cats">
			<div class="categoryList">
				<i class="fas fa-times-circle"></i>
				<ul>
					@foreach(explode(",", $article->categoryNames) as $catName)						 
						<li>{{$catName}}</li>
					@endforeach
				</ul>
			</div>
			{!! count(explode(",", $article->categoryNames)) > 1?"<a href='#' class='seeMore'>See More <i class='far fa-eye'></i></a>":"" !!}
		</div>
		<div class="{{$row}} featured">
			{{ $article->featured == 1?"Yes":"No" }}
		</div>
		<div class="{{$row}}">
			{{$article->dateCreated}}
		</div>
		@php($i++)
	@endforeach
@endif


</div>


@include('partials/javaScriptSort')

<script>
	$('.collatedGrid').on('click', '.seeMore', function(e){
		e.preventDefault();
		$(this).siblings('.categoryList').addClass('show');
	});

	$('.collatedGrid').on('click', '.fas.fa-times-circle', function(){
		$(this).closest('.categoryList').removeClass('show');
	});
</script>
