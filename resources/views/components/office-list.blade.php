<div>
    @foreach($offices as $office)
        <div class="office">

            <div>
                <i class="fa-solid fa-chevron-down"></i> {{$office->name}}
            </div>
            <div class="phone">
                <i class="fa-solid fa-phone"></i> {{$office->phone}}
            </div>
            <div>
                <i class="fa-solid fa-location-dot"></i> {{$office->description}}
            </div>

        </div>
    @endforeach
</div>