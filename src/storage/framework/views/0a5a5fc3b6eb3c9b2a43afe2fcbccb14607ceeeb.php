<div class="star-alignment">
    <h2><?php echo e($count); ?></h2>
    <?php for($i = 1; $i <= 5; $i++): ?>
        <p><button class="star-button <?php echo e($this->starClass($i)); ?>" wire:click="setCount(<?php echo e($i); ?>)">★</button></p>
    <?php endfor; ?>
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
<?php /**PATH /var/www/resources/views/livewire/count.blade.php ENDPATH**/ ?>