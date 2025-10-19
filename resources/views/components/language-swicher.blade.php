<div>
    <div class="locale">
        @if($locale == 'ru')
            RU
        @else
            <a id="lang-swicher" href="{{ $url }}">RU</a>
        @endif
        |
        @if($locale == 'ua')
            UA
        @else
                <a id="lang-swicher" href="{{ $url }}">UA</a>
        @endif
    </div>
</div>
