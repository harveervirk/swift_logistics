
        <fieldset>
          <h2>Step 1: Where is your shipment going</h2>
          <div class="form-group">
            <label for="name2">Name</label>
            <input
              type="name2"
              class="form-control"
              id="name2"
              name="name2"
              placeholder="Name"
            />
            <span class="invalid-name2 text-danger"></span>
          </div>
          <div class="form-group">
            <label for="add12">Address Line1</label>
            <input
              type="text"
              class="form-control"
              id="add12"
              name="add12"
              placeholder="Address Line 1"
            />
            <span class="invalid-add12 text-danger"></span>
          </div>
          <div class="form-group">
            <label for="add22">Address Line2</label>
            <input
              type="text"
              class="form-control"
              id="add22"
              name="add22"
              placeholder="Address Line 2"
            />
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm">
                <label for="city2">City</label>
                <input
                  type="text"
                  class="form-control"
                  id="city2"
                  name="city2"
                  placeholder="City"
                />
                <span class="invalid-city2 text-danger"></span>
              </div>
              <div class="col-sm">
                <label for="prov2">Province</label>
                <select id="prov2" name="prov2" required class="form-control">
                  <option disabled selected value>Select value</option>
                  <option value="BC">BC</option>
                  <option value="AB">AB</option>
                  <option value="NB">NB</option>
                  <option value="NL">NL</option>
                  <option value="NT">NT</option>
                  <option value="NS">NS</option>
                  <option value="NU">NU</option>
                  <option value="ON">ON</option>
                  <option value="PE">PE</option>
                  <option value="QC">QC</option>
                  <option value="SK">SK</option>
                  <option value="YT">YT</option>
                </select>
                <span class="invalid-prov2 text-danger"></span>
              </div>
            </div>
          </div>

          <div class="form-group w-25">
            <label for="pcode2">Postal code</label>
            <input
              type="text"
              class="form-control"
              id="pcode2"
              name="pcode2"
              placeholder="Postal Code"
            />
            <span class="invalid-pcode2 text-danger"></span>
          </div>
          <input type="button" class="next btn btn-primary" value="Next" />
        </fieldset>