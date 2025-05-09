    @csrf
    <label for="">Title</label>
    <input type="text" name="title" value={{ old("title",$post->title) }}>

    <label for="">Slug</label>
    <input type="text" name="slug" value={{ old("slug",$post->slug) }}>

    <label for="">content</label>
    <textarea name="content">{{old("content",$post->content)}}</textarea>

    <label for="">Category</label>
    <select name="category_id" id="">
        @foreach ($categories as $title => $id)
            <option {{ old('category_id',$post->category_id) == $id ?'selected':''}} value="{{ $id }}">{{ $title }}</option>
        @endforeach
    </select>

    <label for="">description</label>
    <textarea name="description">{{old("",$post->description)}}</textarea>

    <label for="">Posted</label>
    <select name="posted" id="">
        <option  {{ $post->posted == 'not' ? 'selected' : '' }} value="not">Not</option>
        <option {{ $post->posted == 'yes' ? 'selected' : '' }} value="yes">Yes</option>
    </select>

    @if (isset($task) && $task == 'edit')

    <label for="">Image</label>
    <input type="file" name="image">
    @endif


    <button type="submit">Send</button>
