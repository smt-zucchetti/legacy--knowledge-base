@foreach($node->childFolders as $childFolder)

	<option value="{{$childFolder->id}}"> 
		{{$prefix}} {{$childFolder->name}}
	</option>

	@if(count($childFolder->childFolders) > 0)
		{{$prefix .= " - -"}}
		@include('partials/printChildFolders', ['node' => $childFolder, 'prefix' => $prefix])
	@endif
		
@endforeach