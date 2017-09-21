<nav class="breadcrumb">
    <?php $breadcrumb_item_active = array_pop($breadcrumb); ?>
    @foreach($breadcrumb as $breadcrumb_item)
        <a class="breadcrumb-item" href="{{ $breadcrumb_item['url'] }}">{{ $breadcrumb_item['name'] }}</a>
    @endforeach
    <span class="breadcrumb-item active">{{ $breadcrumb_item_active['name'] }}</span>
</nav>