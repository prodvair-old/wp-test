<header class="header">
  <div class="container">
    <div class="header__content">
      <div class="header__content__logo">
        <a class="brand" href="{{ home_url('/') }}">
          <div class="logo">
            <span></span>
            <span></span>
            <span></span>
          </div>
          {{ get_bloginfo('name', 'display') }}
        </a>
      </div>
      <a class="header__content__nav-burger">
        <span></span>
      </a>
      <nav class="header__content__nav nav-primary">
        @if (has_nav_menu('primary_navigation'))
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
        @endif
      </nav>
    </div>
  </div>
</header>
