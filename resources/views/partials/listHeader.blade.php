


@switch($type)
	@case('folders')
	@case('categories')

		@if($type == 'folders')
			@php($method = 'sortFolders')
		@else
			@php($method = 'sortCategories')
		@endif

		<div class="collatedGridHeader {{$type}}">
			<div>
				<span class="sortArrow Name" data-method="{{$method}}">
					<a href="#" class="upArrow"></a>
					<a href="#" class="downArrow"></a>
				</span>
				Name
			</div>
			<div></div>
			<div>
				<span class="sortArrow down dateCreated" data-method="{{$method}}">
					<a href="#" class="upArrow"></a>
					<a href="#" class="downArrow"></a>
				</span>
				Date Created
			</div>
		</div>
		@break

	@case('articles')
		<div class="collatedGridHeader {{Auth::check()?'loggedIn':''}}">
			<div>
		 		<span class="sortArrow Title" data-method="sortArticles">
					<a href="#" class="upArrow"></a>
					<a href="#" class="downArrow"></a>
				</span>
				Title 
			</div>
			{!! Auth::check()?"<div>Actions</div>":"" !!}
			<div class="categoryMenuItem">
				<span class="sortArrow categoryNames" data-method="sortArticles">
					<a href="#" class="upArrow"></a>
					<a href="#" class="downArrow"></a>
				</span>
				Category
			</div>
			<div class="featuredMenuItem">
				<span class="sortArrow featured" data-method="sortArticles">
					<a href="#" class="upArrow"></a>
					<a href="#" class="downArrow"></a>
				</span>
				Featured
			</div>
			<div class="dateCreatedMenuItem">
				<span class="sortArrow down dateCreated" data-method="sortArticles">
					<a href="#" class="upArrow"></a>
					<a href="#" class="downArrow"></a>
				</span>
				Date Created
			</div>
		</div>

	@endswitch

