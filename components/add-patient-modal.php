<div id="add-patient-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-1">
                <h6 class="modal-title m-1" id="exampleModalLabel">REGISTER PATIENT</h6>
                <button type="button" class="close m-1 p-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group form-group-sm my-4">
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off" id="fullname" placeholder="Full name">
                    </div>
                    <div class="row px-0 mb-3 mt-2">
                        <div class="col-6 pl-0 pr-2">
                            <input type="text" id="birthdate" class="form-control form-control-sm shadow-none datepicker" autocomplete="off" data-provide="datepicker" data-date-format="dd MM yyyy" placeholder="Birthdate">
                        </div>
                        <div class="col-6 px-0 pt-1">
                            <select class="select" id="gender">
                                <option disabled="disabled" selected="selected">Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm my-4">
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off" id="pnumber" placeholder="Contact number">
                    </div> 
                    <div class="form-group form-group-sm my-4">
                        <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off" id="paddress" placeholder="Address">
                    </div>
                </form>
                
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-sm btn-secondary p-1" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm p-1" id="psubmit">Submit</button>
            </div>
        </div>
    </div>
</div>