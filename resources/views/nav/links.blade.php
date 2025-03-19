<div class="modal fade" id="links_modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-card card" data-list="{&quot;valueNames&quot;: [&quot;name&quot;]}">
          <div class="card-header">

            <!-- Title -->
            <h4 class="card-header-title" id="exampleModalCenterTitle">
              Enlaces disponibles
            </h4>

            <!-- Close -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>

          </div>
        
          <div class="card-body">

            <!-- List group -->
            <ul class="list-group list-group-flush list my-n3">
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-auto">

                         <span class="thin-icon-tag" style="font-size: 35px;"></span>
                        </div>
                        <div class="col ml-n2">

                            <!-- Title -->
                            <h4 class="mb-1 name">
                              {{route('inicio')}}
                            </h4>

                      

                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <button type="button" class="btn btn-sm btn-success btn-enlaces">
                            Seleccionar
                            </button>

                        </div>
                    </div> <!-- / .row -->
                </li>
                <li class="list-group-item">
                    <div class="row align-items-center">
                        
                        <div class="col-auto">

                         <span class="thin-icon-tag" style="font-size: 35px;"></span>
                        </div>
                        <div class="col ml-n2">
                            <!-- Title -->
                            <h4 class="mb-1 name">
                              {{route('index.contacto')}}
                            </h4>

                          
                        </div>
                        <div class="col-auto">

                            <!-- Button -->
                            <button type="button" class="btn btn-sm btn-success btn-enlaces">
                            Seleccionar
                            </button>

                        </div>
                    </div> <!-- / .row -->
                </li>
                <li class="list-group-item">
                  <div class="row align-items-center">
                      
                      <div class="col-auto">

                       <span class="thin-icon-tag" style="font-size: 35px;"></span>
                      </div>
                      <div class="col ml-n2">
                          <!-- Title -->
                          <h4 class="mb-1 name">
                            {{route('ordenar_online')}}
                          </h4>

                        
                      </div>
                      <div class="col-auto">

                          <!-- Button -->
                          <button type="button" class="btn btn-sm btn-success btn-enlaces">
                          Seleccionar
                          </button>

                      </div>
                  </div> <!-- / .row -->
              </li>
             
             </ul>

          </div>
        </div>
      </div>
    </div>
  </div>