@switch($type)
	@case('folders')
	@case('categories')

		<div class="collatedGridHeader {{$type}}" data-action="sort{{ucfirst($type)}}">
			<div class="row">
				@include('partials/html/sortArrows', ['name' => 'name'])
				Name
			</div>
			<div class="row">
				@include('partials/html/sortArrows', ['name' => 'dateCreated', 'selected' => true])
				Date Created
			</div>
			<div class="row noSort">
				Actions
			</div>
		</div>
		@break

	@case('articles')

		<div class="collatedGridHeader {{Auth::check()?'loggedIn':''}}" data-action="sortArticles" data-srchTrm="{{!empty($srchTrm)?$srchTrm:''}}">
			<div class="row">
				@include('partials/html/sortArrows', ['name' => 'title'])
				Title 
			</div>
			<div class="row noSort">
				Categories
			</div>
			<div class="row featuredMenuItem">
				@include('partials/html/sortArrows', ['name' => 'featured'])
				Featured
			</div>
			<div class="row dateCreatedMenuItem">
				@include('partials/html/sortArrows', ['name' => 'dateCreated', 'selected' => true])
				Date Created
			</div>
			{!! Auth::check()?"<div class='row noSort'>Actions</div>":"" !!}
		</div>

	@endswitch

