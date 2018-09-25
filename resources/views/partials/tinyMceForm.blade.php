
    <label for="content"><h3>Content:</h3> </label>
    {{ Form::textarea('content', !empty($article->Content)?$article->Content:"", array('class' => 'form-control my-editor', 'id' => 'tinyMCE')) }}

    <!--<textarea id="tinyMCE" name="content" class="form-control my-editor">{{!empty($article)?$article->Content:''}}</textarea>-->
    <textarea id="textOnlyContent" name="textOnlyContent" >{{!empty($article)?$article->textOnlyContent:''}}</textarea>

