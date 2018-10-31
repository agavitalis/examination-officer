<div id="myModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
  			<!-- Modal content-->
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal">&times;</button>
  					<h4 class="modal-title"></h4>
  				</div>
  				<div class="modal-body">
  					<form class="form-horizontal" role="form">
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="id">Student name:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="s-name" disabled>
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="name">Student Registration Number:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="s-username">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="control-label col-sm-2" for="name">Email Address:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="s-email">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="contros-label col-sm-2" for="name">Date Of Birth:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="dob">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="control-label col-sm-2" for="name">Nationality:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="nationality">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="control-label col-sm-2" for="name">LGA of origin:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="lga">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="control-label col-sm-2" for="name">Residential Address:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="address">
  							</div>
  						</div>
                          <div class="form-group">
  							<label class="control-label col-sm-2" for="name">Biography:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="bio">
  							</div>
  						</div>
  					</form>
  					<div class="deleteContent">
  						Are you Sure you want to delete <span class="dname"></span> ? <span
  							class="hidden did"></span>
							   <span class="hidden lev"></span>
  					</div>
					<div class="error-div">
						<p class="modal-error text-center  alert alert-danger hidden">
						</p>
					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
  							<span id="footer_action_button" class='glyphicon'> </span>
  						</button>
  						<button type="button" class="btn btn-warning" data-dismiss="modal">
  							<span class='glyphicon glyphicon-remove'></span> Close
  						</button>
  					</div>
  		    </div>
    	</div>
 </div>