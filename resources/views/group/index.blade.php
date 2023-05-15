@extends('base')
@section('title')
    Groupes
@endsection

@section('content')


<div class=" ml-5 mr-5 mt-5 mb-5">
    <div class=" mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @forelse ($groups as $group)
              <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-titlev text-center">Echéance: {{ $group->name }} </h5>
                    <p class="card-text ">{{ $group->description }}</p>
                    
                    <div class="card-footer text-center">
                        <form action="{{ route('group.add.user', ['group' =>$group->id, 'user' => Auth::id()]) }}" method="post">
                            @csrf
                            @method('post')
                            
                            <button class="btn btn-info">Rejoindre</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
          @empty
              
          @endforelse
          
        </div>
    </div>



    <div>
        {{ $groups->links() }}
    </div>
</div>


@endsection('content')



