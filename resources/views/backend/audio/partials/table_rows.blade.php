@foreach ($audioFiles as $index => $audio)
<tr>
    <td class="text-center">{{ $index + 1 }}</td>
    <td>{{ $audio->file_name }}</td>
    <td class="text-center">
        <a href="{{ asset($audio->file_path) }}"
           class="btn btn-sm btn-alt-primary"
           download>
            Download
        </a>
    </td>
</tr>
@endforeach
