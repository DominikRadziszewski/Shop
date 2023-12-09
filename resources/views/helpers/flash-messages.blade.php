@if (session('status'))
   <div class="row">
      <div class="col-12">
         <div class="alert alert-success d-flex justify-content-between align-items-center">
           {{ session('status') }}

            <button class="btn-close end" data-bs-dismiss="alert" aria-hidden="true">
              &times;
            </button>
         </div>
   
      </div>
   </div>
 @endif