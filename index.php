<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form with File Upload (Modal)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
   <link rel="stylesheet" href="css/upload_contcts.css">

</head>

<body>

    <div class="container">
        <h2>Multi-Step Form with File Upload (Modal)</h2>
 
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#multiStepModal" data-backdrop="static" data-keyboard="false">
            Open Multi-Step Modal
        </button>

        <!-- Multi-Step Modal -->
        <div class="modal fade" id="multiStepModal" tabindex="-1" role="dialog" aria-labelledby="multiStepModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="multiStepModalLabel">Multi-Step Form</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Step 1: Upload File -->
                        
                       

                        <div class="form-step step1 active">
                            <form method="post" id="upload_form" enctype="multipart/form-data">
                                <div id="drop-area" class="well" onclick="nextStep(1, 1)">
                                    <p id="drop-text">Step 1: Click here or drag and drop a CSV file to upload</p>
                                    <input type="file" id="file-input" accept=".csv" onchange="handleFile(this.files)">
                                    <div id="uploaded-files">
                                        <!-- Display uploaded file information here -->
                                    </div>
                                </div>
                                <div class="step-buttons">
                                    <button type="button" class="btn btn-default" onclick="resetFormInput(event)">Cancel</button>
                                    <button type="button" class="btn btn-success" id="nextButton" disabled onclick="nextStep(1)">Next</button>
                                </div>
                            </form>
                        </div>

                        <!-- Step 2: Map -->
                        <div class="form-step step2">
                            <p>Step 2: Map</p>
                            <p class='alert alert-info'>Map columns before you import.</p>
                            <!-- Add mapping content here -->
                            <div class="table-responsive" id="process_area">

                            </div>
                            <!--
                            <div class="step-buttons">
                                <button type="button" class="btn btn-primary" onclick="prevStep(2)">Previous</button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Import</button>
                            </div>
                             -->

                        </div>

                        <!-- Step 3: Upload Details -->
                        <div class="form-step step3">
                            <p>Step 3: Upload Details</p>
                          
                            <!-- Add upload details content here -->
                            <div class="step-buttons">

                            <button type="button" class="btn btn-default" onclick="prevStep(3)">Previous</button>
                               
                               <button type="button" name="import2" id="import2" class="btn btn-success" >Import</button>
                            </div>
                        </div>

                        <!-- Step 3: Upload Details -->
                        <div class="form-step step4">
                            <p>Step 4: Complete</p>
                            <div id="message">

                            </div>
                            <!-- Add upload details content here -->
                            <div class="step-buttons">

                                <button type="button" id='close' class="btn btn-success" >Complete</button>
                            </div>
                        </div>

                      

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="js/upload_contacts.js"></script>
  
   

</body>

</html>