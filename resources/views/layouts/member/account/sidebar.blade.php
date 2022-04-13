<style>
    ul.list-group > li {
        cursor: pointer;
    }
</style>
<div class="list-group">
    <a href="{{ route('biodatas.create') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->routeIs('biodatas.create') ? 'active' : '' }}">
        Account
    </a>
    <a href="{{ route('payments.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->routeIs('payments.index') ? 'active' : '' }}">
        Payment
    </a>
    <a href="{{ route('suggestions.index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ request()->routeIs('suggestions.index') ? 'active' : '' }}">
        Suggestion
    </a>
</div>
