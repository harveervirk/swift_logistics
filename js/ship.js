  $(document).ready(function () {
    var date = new Date();
    
    date.setDate(date.getDate() + 4);
    $(".ExpressDel").html(date.toDateString());
    date.setDate(date.getDate() + 6);
    $(".StandardDel").html(date.toDateString());
    
    var current = 1,
      current_step,
      next_step,
      steps;
    steps = $("fieldset").length;
    $(".next").click(function () {
       if (current === 1) {
        var t = 1;
        if ($("#name2").val()) {
          $(".invalid-name2").html("");
          $("#name2").removeClass("is-invalid");
        } else {
          $(".invalid-name2").html("Please input receiver's name");
          $("#name2").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking Address line1
        if ($("#add12").val()) {
          $(".invalid-add12").html("");
          $("#add12").removeClass("is-invalid");
        } else {
          $(".invalid-add12").html("Please input receiver's Address Line 1");
          $("#add12").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking City
        if ($("#city2").val()) {
          $(".invalid-city2").html("");
          $("#city2").removeClass("is-invalid");
        } else {
          $(".invalid-city2").html("Please input receiver's City");
          $("#city2").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking Province
        if ($("#prov2").val()) {
          $(".invalid-prov2").html("");
          $("#prov2").removeClass("is-invalid");
        } else {
          $(".invalid-prov2").html("Please input receiver's Province");
          $("#prov2").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking Province
        if ($("#pcode2").val()) {
          const regex = /^[A-Za-z]\d[A-Za-z][-]\d[A-Za-z]\d$/;
          const found = $("#pcode2").val().match(regex);
          if (found) {
            $(".invalid-pcode2").html("");
            $("#pcode2").removeClass("is-invalid");
          } else {
            $(".invalid-pcode2").html("Please input a valid Postal Code");
            $("#pcode2").addClass("is-invalid");
            if (t == 1) t = 0;
          }
        } else {
          $(".invalid-pcode2").html("Please input receiver's Postal Code");
          $("#pcode2").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        if (t === 1) {
          loadnextScreen($(this));
        }
      } else if (current === 2) {
        var t = 1;
        if ($("#weight").val()) {
          $(".invalid-weight").html("");
          $("#weight").removeClass("is-invalid");
        } else {
          $(".invalid-weight").html("Please input Parcel's weight");
          $("#weight").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking Address line1
        if ($("#height").val()) {
          $(".invalid-height").html("");
          $("#height").removeClass("is-invalid");
        } else {
          $(".invalid-height").html("Please input Parcel's height");
          $("#height").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking City
        if ($("#length").val()) {
          $(".invalid-length").html("");
          $("#length").removeClass("is-invalid");
        } else {
          $(".invalid-length").html("Please input Parcel's length");
          $("#length").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        //Checking Province
        if ($("#width").val()) {
          $(".invalid-width").html("");
          $("#width").removeClass("is-invalid");
        } else {
          $(".invalid-width").html("Please input Parcel's width");
          $("#width").addClass("is-invalid");
          if (t == 1) t = 0;
        }
        if (t === 1) loadnextScreen($(this));
      }
      else{
        loadnextScreen($(this))
      }
    });
    $(".previous").click(function () {
      if(current==4)
      current_step = $(this).parent().parent().parent().parent().parent().parent().parent().parent();
      else
      current_step=$(this).parent();
      next_step = current_step.prev();
      next_step.show();
      current_step.hide();
      setProgressBar(--current);
    });
    setProgressBar(current);
    // Change progress bar action
    function setProgressBar(curStep) {
      var percent = parseFloat(100 / steps) * curStep;
      percent = percent.toFixed();
      $(".progress-bar")
        .css("width", percent + "%")
        .html(percent + "%");
    }

    // Loading next screen
    function loadnextScreen(context) {
      current_step = context.parent();
      next_step = context.parent().next();
      next_step.show();
      current_step.hide();
      setProgressBar(++current);
    }
  });
