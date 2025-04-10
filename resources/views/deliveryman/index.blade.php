@extends('layout.app')
@section('content')
<div class="row">
       <div class="col-12">
              <div class="card">
                     <div class="card-header d-flex justify-content-between">
                            <h3>Delivery Men
                            </h3>
                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#new">Create New</button>
                     </div>
                     <div class="card-body">
                            <table class="table">
                                   <thead>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Contact</th>
                                          <th>Action</th>
                                   </thead>
                                   <tbody>
                                          @foreach ($deliverymen as $key => $deliveryman)
                                                 <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$deliveryman->name}}</td>
                                                        <td>{{$deliveryman->contact}}</td>
                                                        <td>
                                                               <button type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#edit_{{$deliveryman->id}}">Edit</button>
                                                        </td>
                                                 </tr>
                                                 <div id="edit_{{$deliveryman->id}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel">Edit Delivery Man</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                                                </div>
                                                                <form action="{{ route('deliveryman.update', $deliveryman->id) }}" method="Post">
                                                                  @csrf
                                                                  @method("patch")
                                                                         <div class="modal-body">
                                                                             <div class="form-group">
                                                                                    <label for="name">Name</label>
                                                                                    <input type="text" name="name" value="{{$deliveryman->name}}" required id="name" class="form-control">
                                                                             </div>
                                                                             <div class="form-group mt-2">
                                                                                    <label for="contact">Contact</label>
                                                                                    <input type="text" name="contact" value="{{$deliveryman->contact}}" id="contact" class="form-control">
                                                                             </div>
                                                                             
                                                                         </div>
                                                                         <div class="modal-footer">
                                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                         </div>
                                                                  </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                          @endforeach
                                   </tbody>
                            </table>
                     </div>
              </div>
       </div>
</div>
<!-- Default Modals -->

<div id="new" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Create New Delivery Man</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{ route('deliveryman.store') }}" method="post">
              @csrf
                     <div class="modal-body">
                            <div class="form-group">
                                   <label for="name">Name</label>
                                   <input type="text" name="name" required id="name" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                   <label for="contact">Contact</label>
                                   <input type="text" name="contact" id="contact" class="form-control">
                            </div>
                           
                     </div>
                     <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                     </div>
              </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

