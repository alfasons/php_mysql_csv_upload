let uploadedFile;
let currentStep = 1;

function openFileInput() {
  // Do nothing here to prevent file selection
}

function handleFile(files) {
  let file = files[0];

  if (file && file.name.toLowerCase().endsWith(".csv")) {
    uploadedFile = file;
    $("#drop-text").text("Step 1: " + file.name);

    let filesContainer = $("#uploaded-files");
    filesContainer.empty();

    let fileItem = $(
      '<div class="file-item">' +
        file.name +
        '<span class="change-btn" onclick="openFileInput()"> &#9998;</span></div>'
    );
    filesContainer.append(fileItem);

    // Enable the first "Next" button since a file is uploaded
    $("#nextButton").prop("disabled", false);
  } else {
    alert("Please select a valid CSV file.");
    $("#file-input").val(""); // Clear the file input
    $("#drop-text").text(
      "Step 1: Click here or drag and drop a CSV file to upload"
    );
    $("#uploaded-files").empty();

    // Disable the first "Next" button if no file is uploaded
    $("#nextButton").prop("disabled", true);
  }
}

function nextStep(step, stage = 0) {
  console.log("forward step is " + step + " and stage is " + stage);

  if (step === 1) {
    if (!uploadedFile) {
      if (stage !== 1) {
        alert("Please upload a file before proceeding to the next step.");
      }
      return;
    } else {
      console.log("file is uploaded");
      if (stage === 1) {
        //need to reupload;
        console.log("need to reupload");
      }
      //upload
      submitForm();
      // Disable the file input to prevent further changes
      $("#file-input").prop("disabled", true);
    }
  }

  $(".form-step.step" + step).removeClass("active");
  $(".form-step.step" + (step + 1)).addClass("active");
  currentStep = step + 1;

  // Enable the file input if navigating back to Step 1
  if (currentStep === 1) {
    $("#file-input").prop("disabled", false);
  }
}

function prevStep(step) {
  console.log("backward step is " + step);
  $(".form-step.step" + step).removeClass("active");
  $(".form-step.step" + (step - 1)).addClass("active");
  currentStep = step - 1;

  // Enable the file input and reset its value if navigating back to Step 1
  if (currentStep === 1) {
    $("#file-input").prop("disabled", false);
    $("#file-input").val(""); // Reset the file input value
    $("#drop-text").text(
      "Step 1: Click here or drag and drop a CSV file to upload"
    );
  }
}

function submitForm() {
  // Add your AJAX form submission logic here
  if (uploadedFile) {
    let formData = new FormData();
    formData.append("file", uploadedFile);

    $.ajax({
      url: "upload.php", // Replace with your actual PHP script
      type: "POST",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      cache: false,
      success: function (response) {
        let kk = "helloooooooo " + response.test;
        console.log("meeee :" + kk);
        console.log("Response :" + response);
        //alert('File submitted successfully. Server response: ' + response.output);
        if (response.error !== "") {
          $("#message").html(
            '<div class="alert alert-danger">' + response.error + "</div>"
          );
        } else {
          $("#process_area").html(response.output);

          //  $('#upload_area').css('display', 'none');
        }

        // Reset modal state
        //  $('#file-input').val('');
        // $('#drop-text').text('Step 1: Click here or drag and drop a CSV file to upload');
        // $('#uploaded-files').empty();
        //uploadedFile = null;
        // Close the modal
        // $('#multiStepModal').modal('hide');
      },
      error: function (xhr, status, error) {
        console.log("File submission failed. Error: " + error);
      },
    });
  } else {
    alert("Please select a CSV file before submitting.");
  }
}
// Add a click event handler to the modal body to prevent advancing when clicking outside the drop area
$("#multiStepModal .modal-body").click(function (event) {
  let dropArea = $("#drop-area")[0];

  // Check if the click event originated from the drop area
  if (event.target === dropArea || $.contains(dropArea, event.target)) {
    event.stopPropagation();
  }
});

function resetFormInput(event) {
  console.log("closed tthe button");
  event.stopPropagation(); // Stop event propagation to prevent advancing to the next step
  $("#file-input").val("");
  $("#drop-text").text(
    "Step 1: Click here or drag and drop a CSV file to upload"
  );
  $("#uploaded-files").empty();
  uploadedFile = null;

  $("#nextButton").prop("disabled", true);
  $("#multiStepModal").modal("hide"); // Close the modal
}

$("#close").click(function (e) {
  e.preventDefault();
  location.reload();
});

//proocess data to database
let total_selection = 0;

let first_name = 0;

let last_name = 0;

let email = 0;

let column_data = [];

$(document).on("change", ".set_column_data", function () {
  let column_name = $(this).val();

  let column_number = $(this).data("column_number");

  if (column_name in column_data) {
    alert("You have already define " + column_name + " column");

    $(this).val("");

    return false;
  }

  if (column_name != "") {
    column_data[column_name] = column_number;
  } else {
    const entries = Object.entries(column_data);

    for (const [key, value] of entries) {
      if (value == column_number) {
        delete column_data[key];
      }
    }
  }

  total_selection = Object.keys(column_data).length;

  if (total_selection == 3) {
    $("#import").attr("disabled", false);

    first_name = column_data.first_name;

    last_name = column_data.last_name;

    email = column_data.email;
  } else {
    $("#import").attr("disabled", "disabled");
  }
});

$(document).on("click", "#import", function (event) {
  console.log('we have click import1')
 nextStep(2)
});

$(document).on("click", "#import2", function (event) {
  event.preventDefault();
console.log('we have click import2')
  $.ajax({
    url: "import.php",
    method: "POST",
    data: { first_name: first_name, last_name: last_name, email: email },
    beforeSend: function () {
      $("#import2").attr("disabled", "disabled");
      $("#import2").text("Importing...");
    },
    success: function (data) {
      $("#import2").attr("disabled", false);
      $("#import2").text("Import");
      $("#process_area").css("display", "none");
      $("#upload_area").css("display", "block");
      $("#upload_form")[0].reset();
      $("#message").html("<div class='alert alert-success'>" + data + "</div>");
      nextStep(3);
    },
  });
});
