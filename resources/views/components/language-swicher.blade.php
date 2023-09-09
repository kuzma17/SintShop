<div>
    <div class="locale">
        @if($locale == 'ru')
            RU
        @else
            <a href="{{ route('locale', 'ru') }}">RU</a>
        @endif
        |
        @if($locale == 'ua')
            UA
        @else
            <a href="{{ route('locale', 'ua') }}">UA</a>
        @endif
    </div>
</div>
