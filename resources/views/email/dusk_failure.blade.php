@forelse ($files as $file)
    <label>{{$file->getFilename()}}</label>
    <img src="{{ $message->embed($file->getPathname()) }}">
@empty
    No images found
@endforelse