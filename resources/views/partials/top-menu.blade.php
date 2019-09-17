<?php

$box = App\Box::first();
$inventory = App\Inventory::first();
$project = App\Project::first();
$product = App\Product::first();
$vendor = App\Vendor::first();



?>
@if(auth()->user()->email == 'admin@admin.com' || auth()->user()->email == 'innovativetim06@gmail.com')
<li class="nav-item">
    <a class="nav-link" href="/home">Home</a>
</li>





<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Products <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('products.index') }}">
            All Products
        </a>
        <hr>
        <a class="dropdown-item" href="{{ route('vendors.index') }}">
            Product vendors
        </a>
        <a class="dropdown-item" href="{{ route('categories.index') }}">
            Product categories
        </a>
    </div>
</li>

<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Projects <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('types.index') }}">
            Project Types
        </a>
        <hr>
        <a class="dropdown-item" href="{{ route('projects.index') }}">
            All Projects
        </a>
    </div>
</li>

<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Inventory <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('inventories.index') }}">
            All Inventory
        </a>

        <a class="dropdown-item" href="{{route('inventories.underPar')}}">
            Inventory under par
        </a>

    </div>
</li>

<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Retention <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('boxes.index') }}">
            Open Boxes
        </a>
        <hr>
        <a class="dropdown-item" href="{{ route('ret.closed') }}">
            Closed Boxes
        </a>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('countries.index') }}">Countries</a>
</li>


@else

    <li class="nav-item">
        <a class="nav-link" href="/home">Home</a>
    </li>

    @can('browse', $vendor)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('vendors.index') }}">Vendors</a>
        </li>
    @endcan

    @can('browse', $product)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
        </li>
    @endcan

    @can('browse', $project)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
        </li>
    @endcan

    @can('browse', $inventory)
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Inventory <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('inventories.index') }}">
                    All Inventory
                </a>

            </div>
        </li>
    @endcan

    @can('browse', $box)
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Retention <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('boxes.index') }}">
                    Open Boxes
                </a>
                <hr>
                <a class="dropdown-item" href="{{ route('ret.closed') }}">
                    Closed Boxes
                </a>
            </div>
        </li>
    @endcan

@endif


