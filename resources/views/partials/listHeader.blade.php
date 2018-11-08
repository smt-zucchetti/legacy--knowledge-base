@switch($type)
	@case('folders')
	@case('categories')

		@php($action = ($type == "folders")?"sortFolders":"sortCategories")
		@php($name = ($type === "folders")?"name":"Name")

		<div class="collatedGridHeader {{$type}}" data-action="{{$action}}">
			<div class="row">
				@include('partials/sortArrows', ['name' => $name])
				Name
			</div>
			<div class="row">
				@include('partials/sortArrows', ['name' => 'dateCreated', 'selected' => true])
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
				@include('partials/sortArrows', ['name' => 'Title'])
				Title 
			</div>
			<div class="row noSort">
				Categories
			</div>
			<div class="row featuredMenuItem">
				@include('partials/sortArrows', ['name' => 'featured'])
				Featured
			</div>
			<div class="row dateCreatedMenuItem">
				@include('partials/sortArrows', ['name' => 'dateCreated', 'selected' => true])
				Date Created
			</div>
			{!! Auth::check()?"<div class='row noSort'>Actions</div>":"" !!}
		</div>

	@endswitch

