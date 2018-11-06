@switch($type)
	@case('folders')
	@case('categories')

		@php($action = ($type == "folders")?"sortFolders":"sortCategories")
		@php($name = ($type === "folders")?"name":"Name")

		<div class="collatedGridHeader {{$type}}" data-action="{{$action}}">
			<div>
				@include('partials/sortArrows', ['name' => $name])
				Name
			</div>
			<div></div>
			<div>
				@include('partials/sortArrows', ['name' => 'dateCreated', 'selected' => true])
				Date Created
			</div>
		</div>
		@break

	@case('articles')

		<div class="collatedGridHeader {{Auth::check()?'loggedIn':''}}" data-action="sortArticles" data-srchTrm="{{!empty($srchTrm)?$srchTrm:''}}">
			<div>
				@include('partials/sortArrows', ['name' => 'Title'])
				Title 
			</div>
			{!! Auth::check()?"<div>Actions</div>":"" !!}
			<div class="categoryMenuItem">
				Categories
			</div>
			<div class="featuredMenuItem">
				@include('partials/sortArrows', ['name' => 'featured'])
				Featured
			</div>
			<div class="dateCreatedMenuItem">
				@include('partials/sortArrows', ['name' => 'dateCreated', 'selected' => true])
				Date Created
			</div>
		</div>

	@endswitch

