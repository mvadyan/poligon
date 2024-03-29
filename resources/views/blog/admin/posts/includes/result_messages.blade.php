@if($errors->any())
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close float-right" data-bs-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <ul>
                    @foreach($errors->all() as $errorTxt)
                        <li>{{ $errorTxt }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@if(session('success'))
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="alert alert-success" role="alert">
                <button type="button" class="close float-right" data-bs-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                {{session('success')}}
            </div>
        </div>
    </div>
@endif
