<div class="m-4">

   @if (session()->has('success'))


   <div class="alert alert-success custom-alert">
    
    {{ session('success') }}
   </div>
   @endif
   @if (session()->has('error'))
   <div class="alert alert-danger custom-alert">

    {{ session('error') }}
   </div>
   @endif


</div>
