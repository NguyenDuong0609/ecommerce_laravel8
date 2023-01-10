<div class="categories-menu">
    <div class="category-heading">
        <h3> All Departments <i class="pe-7s-angle-down"></i></h3>
    </div>
    <div class="category-menu-list">
        <ul>
            @if(count($categories) > 0)
                @foreach ($categories as $category)
                    @if(count($category->children) > 0)
                    <li>
                        <a href="{{ env('DOMAIN') }}/category/{{ $category->id }}"><img alt="" src="ezone/assets/img/icon-img/7.png">{{ $category->name }}<i class="pe-7s-angle-right"></i></a>
                        <div class="category-menu-dropdown">
                            <div class="category-dropdown-style category-common3">
                                <ul>
                                    @foreach ($category->children as $children)

                                    @endforeach
                                    <li><a href="{{ env('DOMAIN') }}/category/{{ $children->id }}">{{ $children->name }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @else
                        <li>
                            <a href="{{ env('DOMAIN') }}/category/{{ $category->id }}"><img alt="" src="ezone/assets/img/icon-img/13.png">{{ $category->name }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>
