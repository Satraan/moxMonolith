<div class="three wide column">
<div class="ui vertical pointing menu">
    <a href="/user/dashboard" class="{{ Request::is('*/dashboard') ? 'active' : '' }} item">
        Dashboard
    </a>
    <a href="/user/wishlist" class="{{ Request::is('*/wishlist') ? 'active' : '' }} item">
        My Wishlists
    </a>
    <a href="/user/alerts" class="{{ Request::is('*/alerts') ? 'active' : '' }} item">
        Alerts
    </a>
    <a href="/user/settings" class="{{ Request::is('*/settings') ? 'active' : '' }} item">
        Settings
    </a>
</div>
</div>
