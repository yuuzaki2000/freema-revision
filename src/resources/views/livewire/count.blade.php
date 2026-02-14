<div class="total-modal-container">
    <div class="upper-modal-container"><p style="font-size:25px;font-style:bold;">取引が完了しました</p></div>
    <div class="middle-modal-container">
        <div><p>今回の取引相手はどうでしたか？</p></div>
        <div class="star-alignment">
            @for ($i = 1; $i <= 5; $i++)
                <p><button class="star-button {{$this->starClass($i)}}" wire:click="setCount({{$i}})">★</button></p>
            @endfor
        </div>
    </div>
    <div class="bottom-modal-container">
        <button class="send-star-button" wire:click="sendStar">送信する</button>
    </div>
</div>
   
<style>
    .total-modal-container {
    }


    .upper-modal-container {
        border-bottom: 1px solid black;
    }

    .middle-modal-container {
        border-bottom: 1px solid black;
    }

    .bottom-modal-container {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }

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

    .send-star-button {
        background-color: #FF8282;
        color: #FFF;
        width: 20vh;
        height: 4vh;
    }
</style>
