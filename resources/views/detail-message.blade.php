<ul class="list-unstyled chat-history">
    @foreach ($messages->reverse() as $date => $group)
        <li class="d-flex justify-content-center">
            <span class="badge bg-primary align-items-center">
                {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
            </span>
        </li>

        @foreach ($group->reverse() as $message)
            <div class="gap-3 hstack align-items-start my-3 justify-content-{{ $message->id_pengirim == $id ? 'start' : 'end' }}">
                <div class="{{ $message->id_pengirim == $id ? '' : 'text-end' }}">
                    <div class="p-2 {{ $message->id_pengirim == $id ? 'text-bg-light' : 'bg-info-subtle' }} text-dark rounded-1 d-inline-block fs-3">
                        {{ $message->body }}
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</ul>
