
    <div class="col-md-11 col-sm-11 col-xs-11 rightSideWrapper">
        <!-- <a class="btn btn-primary right" data-toggle="modal" data-target="#addUser"><i class="fa fa-plus fa-fw m-right-xs"></i>Network</a> -->
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fas fa-wifi"></i> Network
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtAllUsers table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">Mikrotik IP Address </th>
                            <th class="column-title" style="display: table-cell;">Mikrotik User  </th>
                            <th class="column-title" style="display: table-cell;">Mikrotik Password </th>
                            <th class="column-title" style="display: table-cell;">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr class="even pointer">
                                <td><?php echo settings()[0]->mkipadd; ?></td>
                                <td><?php echo settings()[0]->mkuser; ?></td>
                                <td><?php echo settings()[0]->mkpassword; ?></td>

                                <td class="action-link">
                                    <a href="#" data-toggle="modal" data-target="#addUser"><span class="label label-warning"><i class="fas fa-edit"></i></span></a>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Edit Network </h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>network/update" accept-charset="utf-8">
                      <div class="item form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12">Mikrotik IP Address <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" name="mkipadd" type="text" placeholder="Enter Your Mikrotik Router IP" value="<?php echo settings()[0]->mkipadd; ?>" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12">Mikrotik User <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" name="mkuser" type="text" placeholder="Enter Mikrotik User" value="<?php echo settings()[0]->mkuser; ?>" required>
                          </div>
                      </div>
                      <div class="item form-group">
                          <label class="control-label col-md-4 col-sm-4 col-xs-12">Mikrotik Password <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12" name="mkpassword" type="text" placeholder="Enter Mikrotik Password" value="<?php echo settings()[0]->mkpassword; ?>" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Save Now</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
      </div>
    </div>

    <!-- Start IP -->

        <a class="btn btn-primary right" data-toggle="modal" data-target="#ipid"><i class="fa fa-plus fa-fw m-right-xs"></i>Add IP</a>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fas fa-key"></i> IP Address
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="dtAllUsers table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;"> Interface </th>
                            <th class="column-title" style="display: table-cell;"> Address </th>
                            <th class="column-title" style="display: table-cell;"> Network </th>
                            <th class="column-title" style="display: table-cell;"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($ipaddresses) && is_object($ipaddresses)){ foreach ($ipaddresses as $row) { ?> 
                            <tr class="even pointer">
                                <td><?php echo $row->getProperty('interface'); ?></td>
                                <td><?php echo $row->getProperty('address'); ?></td>
                                <td><?php echo $row->getProperty('network'); ?></td>
                                <td class="action-link">
                                    <a href="#" ><span class="label label-danger delete"><i class="fas fa-times-circle"></i></span></a>
                                </td>
                            </tr>
                        <?php } } ?>                            
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ipid" tabindex="-1" role="dialog" aria-labelledby="ipid">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ipid"> Add IP Address </h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal form-label-left" role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>network/addIpAddress" accept-charset="utf-8">
                          
                          <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Interface <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="interface" required>
                                        <option value="">Select Interface</option>
                                        <?php foreach($interfaces as $interface){ ?>
                                            <option value="<?php echo $interface('name'); ?>"><?php echo $interface('name'); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                          <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Address <span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="address" type="text" placeholder="Address Ex: 10.10.10.1/24" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                  <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Add Now </button>
                              </div>
                          </div>
                  </form>
              </div>
            </div>
      </div>
    </div>

    <!-- Stop IP -->
    
</div><!-- Container -->
