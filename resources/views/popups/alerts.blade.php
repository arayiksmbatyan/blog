@if (session('success'))
   <div class="alert alert-success">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       {{session('success') }}
   </div>
@endif

@if (session('error'))
   <div class="alert alert-danger">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       {{session('error') }}
   </div>
@endif
@if (count($errors) > 0)
   <div class="alert alert-danger">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif