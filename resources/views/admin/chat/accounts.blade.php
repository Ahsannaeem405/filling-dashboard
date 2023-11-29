<ul>
    @if(isset($accounts))
        @foreach ($accounts as $account)
            <li class="list-style" data-refresh="{{ $account->refreshToken }}" data-user-id="{{ $account->account_id }}" data-id="{{ $account->id }}">
                <span class="initials mr-1">{!! strtoupper(substr($account->description,0,2))  !!}</span>
                <?php
                    $string = $account->description;
                    $parts = explode(':', $string);
                    $email = $parts[0]; 
                ?>
                {{ $email }}
            </li>
        @endforeach
    @endif
</ul>