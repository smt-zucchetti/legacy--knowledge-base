

@foreach($items as $item)

	@switch($item[0])

		@case('back')
			<a id="goBack" href="javascript:window.history.back();" >
				<i class="fas fa-reply"></i> {{$item[1]}}
			</a>
		@break;

		@case('createArticle')
			@if (Auth::check())
				<a href="{{ url('/createArticle') }}">
					<i class="fas fa-plus"></i> {{$item[1]}} 
				</a>
			@endif
		@break

		@case('updateArticle')
			@if (Auth::check())
				<a href="{{ url('/updateArticle/'.$article->id) }}" >
					<i class="fas fa-pencil-alt"></i> 
					<span class="tag">Edit</span>
				</a>
			@endif
		@break

		@case('deleteArticle')
		@case('createCategory')
		@case('deleteCategory')
		@case('updateCategory')
		@case('createFolder')
		@case('deleteFolder')
		@case('updateFolder')
			@if (Auth::check())

				<div style="display: none;" id="{{$item[0]}}_{{$objId}}">
					@include("partials/smallForms/".$item[0])
				</div>
				<a data-fancybox data-src="#{{$item[0]}}_{{$objId}}" href="javascript:;">
					@switch($item[1])
						@case('Delete')
							<i class="fas fa-trash-alt"></i>  
						@break
						@case('Update')
							<i class="fas fa-pencil-alt"></i>
						@break
						@case('Add New')
							<i class="fas fa-plus"></i>
						@break
					@endswitch
					<span class="tag">{{$item[1]}}</span>
				</a>
			@endif
		@break
	@endswitch
@endforeach


