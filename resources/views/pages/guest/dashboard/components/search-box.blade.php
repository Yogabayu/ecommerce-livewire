<div class="hero__search__form">
    <form wire:submit.prevent='search'>
        <input type="text" placeholder="What do yo u need?" id="inputText" wire:model='inputText'>
        <button type="submit" class="site-btn">SEARCH</button>
    </form>
</div>
