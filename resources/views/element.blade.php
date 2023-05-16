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
  
  <div class="border-top my-3" style="height: 2px; background-color: #000;"></div> <!-- Trait horizontal personnalisé -->

  <div class="separator"></div> 

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


<div class="fixed-top">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h5 class="text-white h4">Collapsed content</h5>
      <span class="text-muted">Toggleable via the navbar brand.</span>
    </div>
  </div>
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
</div>