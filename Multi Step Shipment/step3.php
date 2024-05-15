<fieldset>
          <h2>Step 3: Select Shipping Type</h2>
          
          <div class="form-group">
            <div class="row">
            <div class="card-body show">
            <div class="row">
              <div class="col">
                <h5><b>Almost Done!</b></h5>
              </div>
            </div>
            <div
              class="radio-group row justify-content-between px-3 text-center a"
            >
              <div value='standard'
                class="col-auto mr-sm-2 mx-1 card-block py-0 text-center radio selected"
              >
                <div class="flex-row">
                  <div class="col">
                    <div class="pic">
                      <img
                        class="irc_mut img-fluid"
                        src="https://cdn-icons-png.flaticon.com/512/6213/6213198.png"
                        width="100"
                        height="100"
                      />
                    </div>
                    <p>Standard</p>
                    <p>Estimated delivery: <span class="StandardDel"></span></p>
                    <p>$400</p>
                  </div>
                </div>
              </div>
              <div value='express'
                class="col-auto ml-sm-2 mx-1 card-block py-0 text-center radio"
              >
                <div class="flex-row">
                  <div class="col">
                    <div class="pic">
                      <img
                        class="irc_mut img-fluid"
                        src="https://media.istockphoto.com/vectors/express-delivery-icon-concept-truck-with-stop-watch-icon-for-service-vector-id849921508?k=20&m=849921508&s=612x612&w=0&h=FaatDTQJIh6pYE_fUvw043ajTHBUKIjU-ttkrd5drrk="
                        width="100"
                        height="100"
                      />
                    </div>
                    <p>Express</p>
                    <p>Estimated delivery: <span class="ExpressDel"></span></p>
                    <p>$500</500>
                  </div>
                </div>
              </div>
            </div>
          </div>
            </div>
          </div>
          <div style="display :none">
              <input type="radio" id="express" name="shipping"  value="Express">
              <input type="radio" id="standard" name="shipping" selected  value="Standard">
          </div>



          <input
            type="button"
            name="previous"
            class="previous btn btn-primary"
            value="Previous"
          />
          <input type="button" class="next btn btn-primary" value="Next" />
        </fieldset>