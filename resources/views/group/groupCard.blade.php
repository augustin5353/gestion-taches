
<div class="">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @forelse ($groups as $group)
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="">  {{ $group->name}} </h5>
                <p class="card-text ">{{ $group->description }}</p>
                
                <div class="d-flex align-items-center justify-content-md-en gap-2 card-footer">
                  
                    <a href="{{ route('group.edit', ['group' => $group->id ])}} " class=" stretched-link">Work</a>   
                        
                </div>
              </div>
            </div>
          </div>
      @empty
          
      @endforelse
      
    </div>
  </div>