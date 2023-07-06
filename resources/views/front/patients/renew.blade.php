 <!-- Modal Delete -->
 <div class="modal fade" id="renew" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <p class="small-heading">
                     هل أنت متأكد من تجديد الباكدج ؟
                 </p>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">تراجع</button>
                 <button class="btn btn-sm btn-success px-3" data-bs-dismiss="modal"
                     wire:click="renewPackage">نعم</button>
             </div>
         </div>
     </div>
 </div>
