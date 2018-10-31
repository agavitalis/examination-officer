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
  							<label class="control-label col-sm-2" for="id">Course Code:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="course-code">
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="name">Course Title:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="course-title">
  							</div>
						</div>
						<div class="form-group">
  							<label class="control-label col-sm-2" for="name">Course Unit:</label>
  							<div class="col-sm-10">
  								<input type="number" class="form-control" id="course-unit">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="control-label col-sm-2" for="name">Semester:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="course-semester">
  							</div>
  						</div>
                        <div class="form-group">
  							<label class="control-label col-sm-2" for="name">Level:</label>
  							<div class="col-sm-10">
  								<input type="name" class="form-control" id="course-level">
  							</div>
						</div>
						<div class="stat form-group">
  							<label class="control-label col-sm-2" for="name">Status:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="course-status">
  							</div>
						</div>
						<div class="checkbox icheck hidden">
                            <label><b>Course Status:</b>
                            Compulsory: <input type="radio"  name="status" value="Compulsory" id="status">
                            Elective: <input type="radio"  name="status" value="Elective" id="status">
                            </label>
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