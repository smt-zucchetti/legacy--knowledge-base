@if ($errors->any())
    <div class="validationAlerts">
    	<h3>Correct the Following Errors</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

