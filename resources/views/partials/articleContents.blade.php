<label for="title">Title:
	{{ Form::text('title', !empty($article->Title)?$article->Title:'', ['id' => 'title', $readOnly?"readonly":""]) }}
</label>

<label for="featured">Featured:
	<input type="checkbox" name="featured" {{$article->featured == 1?'checked':''}} id="featured" {!!$readOnly?"onclick='return false;'":""!!} />
</label>
	
<label class="detached">Categories: </label>
@if($readOnly)
	@if(!empty($article->categoryNames))
		<ul class="categoryList">
			@foreach(explode(",",$article->categoryNames) as $categoryName)						 
				<li class='category'>{{$categoryName}}</li>
			@endforeach
		</ul>
	@endif
@else
	<ul class="categoryList formCheckbox">
		@foreach($categories as $category)
			<li>
				<label for="{{$category->ID}}">{{$category->Name}}
						@if(!empty($article) && in_array($category->ID, explode(",",$article->categoryIds)))
							{{Form::checkbox('CategoryIDs[]', $category->ID, true, ['id' => $category->ID])}}
						@else
							{{Form::checkbox('CategoryIDs[]', $category->ID, false, ['id' => $category->ID])}}
						@endif
				</label>
			</li>
		@endforeach
	</ul>
@endif

@if($readOnly)
	<label for="parentFolder">Parent Folder: 
		<span class="value">{{$article->parentFolder}}</span>
	</label>
@else
	<label for="parentFolder" class="detached">Parent Folder: </label>
	@include('partials/foldersSelectBox', ['formType' => $formType])
@endif

<label for="content" class="detached">Content: </label>
@if($readOnly)
	<div class="singleArticleBorder">
		{!! $article->Content !!}
	</div>
@else
	{{ Form::textarea('content', !empty($article->Content)?$article->Content:"", array('class' => 'form-control my-editor', 'id' => 'tinyMCE')) }}
	<textarea id="textOnlyContent" name="textOnlyContent" >{{!empty($article)?$article->textOnlyContent:''}}</textarea>
@endif