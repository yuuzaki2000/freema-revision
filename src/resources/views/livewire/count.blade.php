<div class="star-alignment">
    <h2>{{$count}}</h2>
    @for ($i = 1; $i <= 5; $i++)
        <p><button class="star-button {{$this->starClass($i)}}" wire:click="setCount({{$i}})">★</button></p>
    @endfor
</div>
<style>
    .star-alignment {
        display: flex;
        flex-direction: row;
    }

    .star-button {
        font-size:  2.5rem;
        background: none;
        border: none;
        cursor: pointer;
        color: gray;
    }

    .filled {
        color: yellow;
    }
</style>
