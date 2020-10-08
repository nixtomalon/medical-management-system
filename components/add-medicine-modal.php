<div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-1">
                        <h6 class="modal-title m-1" id="exampleModalLabel">ADD NEW MEDICINE</h6>
                        <button type="button" class="close m-1 p-0" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-4">
                        <form>
                            <div class="form-group form-group-sm">
                                <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off" id="mName" placeholder="Name">
                            </div>
                            <div class="form-group form-group-sm my-4">
                                <input type="text" class="form-control form-control-sm shadow-none" autocomplete="off" id="mBrand" placeholder="Brand">
                            </div>
                            <div class="form-group form-group-sm my-4">
                                <input type="number" class="form-control form-control-sm shadow-none" autocomplete="off" id="mMg" placeholder="Miligram">
                            </div>
                            <div class="form-group form-group-sm my-4">
                                <input type="text" id="mDate" autocomplete="off" class="form-control form-control-sm datepicker shadow-none" data-provide="datepicker" data-date-format="dd MM yyyy" placeholder="Expiration date">
                            </div>
                            <div class="form-group form-group-sm mt-4">
                                <input type="number" class="form-control form-control-sm shadow-none" autocomplete="off" id="mStock" placeholder="Stock">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer p-1">
                        <button type="button" class="btn btn-sm btn-secondary p-1" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm p-1" id="save">Submit</button>
                </div>
            </div>
        </div>
    </div>