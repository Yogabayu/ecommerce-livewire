<div class="hero__search__form">
    <form wire:submit.prevent='search'>
        <input type="text" placeholder="Apa yang kamu cari?" id="inputText" wire:model='inputText'>
        <button type="submit" class="site-btn">CARI</button>
    </form>
</div>
