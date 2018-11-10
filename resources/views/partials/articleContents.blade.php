<label for="title">Title:
	{{ Form::text('title', !empty($article)?$article->title:'', ['id' => 'title', $readOnly?"readonly":""]) }}
</label>

<label for="featured">Featured:
	<input type="checkbox" name="featured" value="1" {{!empty($article) && $article->featured == 1?'checked':''}} id="featured" {!!$readOnly?"onclick='return false;'":""!!} />
</label>
	
@if($readOnly)
	
		@if(!empty($article->categoryNames))
			<label class="detached">Categories: </label>
			<ul class="categoryList">
				@foreach(explode(",",$article->categoryNames) as $categoryName)						 
					<li class='category'>{{$categoryName}}</li>
				@endforeach
			</ul>
		@else
			<label class="detached">Categories: 
				&nbsp;&nbsp;None
			</label>
		@endif
@else
	<label class="detached">Categories:</label>
	<ul class="categoryList formCheckbox">
		@foreach($categories as $category)
			<li>
				<label for="{{$category->id}}">{{$category->name}}
					@if(!empty($article) && in_array($category->id, explode(",",$article->categoryIds)))
						{{Form::checkbox('categoryIds[]', $category->id, true, ['id' => $category->id])}}
					@else
						{{Form::checkbox('categoryIds[]', $category->id, false, ['id' => $category->id])}}
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
		{!! $article->content !!}
	</div>
@else
	{{ Form::textarea('content', !empty($article)?$article->content:"", ['class' => 'form-control my-editor', 'id' => 'tinyMCE']) }}
	{{ Form::textarea('textOnlyContent', !empty($article)?$article->textOnlyContent:"", ['id' => 'textOnlyContent']) }}
@endif