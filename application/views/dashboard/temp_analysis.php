<!-- page content -->
<div class="right_col" role="main">
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <div class="x_title">
            <h2>Location Temperature Analysis</h2>
               <div class="clearfix"></div>
         </div>
         <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left input_mask">
            <div class='col-sm-4'>
                    Start Date
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
               <div class='col-sm-4'>
                    End Date
                    <div class="form-group">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

              <!-- <div class="ln_solid"></div>
               <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                     <button type="button" class="btn btn-primary">Cancel</button>
                     <button class="btn btn-primary" type="reset">Reset</button>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </div>
               </div>-->
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->
<?php  $this->load->view('layout/footer'); ?>