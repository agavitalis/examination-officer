 @if ($message = Session::get('error')) 
        <div class="alert alert-danger alert-dismissible ">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Error!</h4>
                 
                 {{ Session::get('error') }}
                
               
        </div>
@endif
@if ($message = Session::get('success')) 
        <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Success!</h4>
                 {{ Session::get('success') }}
                
        </div>
@endif
@if ($message = Session::get('info')) 
        <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> Info!</h4>
                 {{ Session::get('info') }}
                
        </div>
@endif
