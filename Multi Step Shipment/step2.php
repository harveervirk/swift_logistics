<fieldset>
          <h2>Step 2: Dimensions of the Parcel</h2>
          <div class="form-group">
            <label for="weight">Weight in lbs</label>
            <input
              type="number"
              class="form-control"
              id="weight"
              name="weight"
              placeholder="Weight"
            />
            <span class="invalid-weight text-danger"></span>
          </div>
          <div class="form-group">
            <label for="length">Length in cms</label>
            <input
              type="number"
              class="form-control"
              id="length"
              name="length"
              placeholder="Length"
            />
            <span class="invalid-length text-danger"></span>
          </div>
          <div class="form-group">
            <label for="width">Width in cms</label>
            <input
              type="number"
              class="form-control"
              id="width"
              name="width"
              placeholder="Width"
            />
            <span class="invalid-width text-danger"></span>
          </div>
          <div class="form-group">
            <label for="height">Height in cms</label>
            <input
              type="number"
              class="form-control"
              id="height"
              name="height"
              placeholder="Height"
            />
            <span class="invalid-height text-danger"></span>
          </div>
          <input
            type="button"
            name="previous"
            class="previous btn btn-primary"
            value="Previous"
          />
          <input type="button" class="next btn btn-primary" value="Next" />
        </fieldset>