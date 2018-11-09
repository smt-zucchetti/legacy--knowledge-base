@if ($errors->any())
    <div class="validationError">
    	<h3>Please correct the following errors:</h3>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

