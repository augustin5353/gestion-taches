{{-- menu dialog --}}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Contenu de la fenêtre modale -->
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">Option 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Option 2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Option 3</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  

{{-- drop menu --}}

<ul class="nav nav-pills">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Élément 1
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdown1">
        <a class="dropdown-item" href="#">Option 1</a>
        <a class="dropdown-item" href="#">Option 2</a>
        <a class="dropdown-item" href="#">Option 3</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Élément 2
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdown2">
        <a class="dropdown-item" href="#">Option 1</a>
        <a class="dropdown-item" href="#">Option 2</a>
        <a class="dropdown-item" href="#">Option 3</a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Élément 3
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdown3">
        <a class="dropdown-item" href="#">Option 1</a>
        <a class="dropdown-item" href="#">Option 2</a>
        <a class="dropdown-item" href="#">Option 3</a>
      </div>
    </li>
</ul>