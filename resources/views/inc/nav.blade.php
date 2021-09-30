<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div id="navbarSupportedContent">
    <ul class="navbar-nav d-inline-flex">
    <?php $route = Illuminate\Support\Facades\Route::current();?>
      <li class="nav-item <?php echo ($route->uri == '/')? "active" : ""  ;?>">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item<?php echo ($route->uri == '/todo/create')? "active" : ""  ;?>">
        <a class="nav-link" href="/todo/create">Create</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout">Logout</a>
      </li>
      
    </ul>
  </div>
</nav>