{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Members" icon="la la-user" :link="backpack_url('member')" />
<x-backpack::menu-item title="Authors" icon="la la-user-astronaut" :link="backpack_url('author')" />
<x-backpack::menu-item title="Books" icon="la la-book" :link="backpack_url('book')" />